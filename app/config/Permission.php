<?php
use \Phalcon\Mvc\Dispatcher,
    \Phalcon\Events\Event,
    \Phalcon\Acl;

class Permission extends \Phalcon\Mvc\User\Plugin {
    const GUEST = 'guest';
    const USER  = 'user';
    const ADMIN = 'admin';

    protected $_publicResources = [
        'index' => ['*']
    ];

    protected $_userResources = [
        'dashboard' => ['*']
    ];

    protected $_adminResources = [
        'admin' => ['*']
    ];

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {

        $role = $this->session->get('role');
        if(!$role) $role = self::GUEST;

        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher-> getActionName();

        $acl = $this->_getAcl();
        $allowed = $acl->isAllowed($role, $controller, $action);
        if($allowed != Acl::ALLOW) {
            $this->flash->error("You do not have permission to access this area");
            $this->redirectBack();
            return false;
        }
    }

    protected function _getAcl() {
        if (!isset($this->persistent->acl)) {
            $acl = new Acl\Adapter\Memory();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                self::GUEST => new Acl\Role(self::GUEST),
                self::USER => new Acl\Role(self::USER),
                self::ADMIN => new Acl\Role(self::ADMIN)
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Public Resources
            foreach ($this->_publicResources as $resourceAction => $action) {
                $acl->addResource(new Acl\Resource($resourceAction), $action);
            }

            // User Resources
            foreach ($this->_userResources as $resourceAction => $action) {
                $acl->addResource(new Acl\Resource($resourceAction), $action);
            }

            // Admin Resources
            foreach ($this->_adminResources as $resourceAction => $action) {
                $acl->addResource(new Acl\Resource($resourceAction), $action);
            }

            // Allow all roles to acces the public resources
            foreach($roles as $role) {
                foreach($this->_publicResources as $resource => $actions) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // Allow user and admin to access the user resources
            foreach($this->_userResources as $resource => $actions) {
                foreach($actions as $action) {
                    $acl->allow(self::USER, $resource, $action);
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            // Allow admin to access the admin resources
            foreach($this->_adminResources as $resource => $actions) {
                foreach($actions as $action ) {
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }
        return $this->persistent->acl;
    }

    protected function redirectBack() {
        $backUrl = $this->request->getHTTPReferer();
        return $this->response->redirect($backUrl);
    }
}