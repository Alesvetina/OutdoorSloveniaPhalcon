<?php
use \Phalcon\Tag;

class IndexController extends BaseController
{
    public function onConstruct() {
        parent::initialize();
    }

    public function indexAction() {
        Tag::setTitle("Home");
    }

    public function doSigninAction() {
        $this->view->disable();
//        if (!$this->security->checkToken()) {
//            $this->flash->error("Invalid CSRF token");
//            $this->response->redirect("index");
//            return;
//        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByEmail($email);
        if($user) {
            if($this->security->checkHash($password, $user->password)) {
                $this->component->user->createSession($user);
                $this->response->redirect("dashboard/index");
                return;
            }
        }
        $this->flash->error("Username or password wrong");
        $this->response->redirect("index/index");
    }

    public function registerAction() {
        Tag::setTitle("Register");
//        $this->assets->addCss('http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.css', false);
//        $this->assets->addJs('http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.js', false);

        $user = new User();

        $registerForm = new Component\Form();
        $registerForm
            ->setAction($this->url->get('index/doRegister'))
            ->setHandle('user')
            ->setDefinitions($user->getRegisterForm());
        $this->view->addForm('registerForm',$registerForm);
    }

    public function doRegisterAction() {
        $this->view->disable();
//        if (!$this->security->checkToken()) {
//            $this->flash->error("Invalid CSRF token");
//            $this->response->redirect("index");
//            return;
//        }

        $email = $this->request->getPost('email');
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $pickup_place = $this->request->getPost('pickup_place');

        if($password != $confirm_password) {
            $this->flash->error("Your passwords do not match");
            $this->response->redirect("index/register");
        }

        $user = new User();
        $user->role = Permission::USER;
        $user->email = $email;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->password = $password;
        $user->pickup_place = $pickup_place;
        $user->phone = '040436199';
        $user->active_code = 'dsgflfksdkfds';
        $result = $user->save();

        if(!$result) {
            $output = [];
            foreach($user->getMessages() as $message) {
                $output[] = $message;
            }
            $output = implode(', ', $output);
            $this->flash->error($output);
            $this->response->redirect("index/register");
            return;
        }
        $this->flash->success("Successfully registered");
        $this->response->redirect("index/");
    }

    public function signoutAction() {
        $this->session->destroy();
        $this->response->redirect("index");
    }
}