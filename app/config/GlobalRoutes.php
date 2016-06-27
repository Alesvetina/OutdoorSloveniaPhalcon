<?php

class GlobalRoutes extends \Phalcon\Mvc\Router\Group {
    public function initialize() {
        $this->add('/superhero/jump:int', [
            'controller' => 'test',
            'action' => 'jump',
            'id' => 1
        ]);
    }
}