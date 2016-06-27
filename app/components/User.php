<?php
namespace Component;

class User extends \Phalcon\Mvc\User\Component {

    public function createSession(\User $user) {
        $this->session->set('id', $user->id);
        $this->session->set('email', $user->email);
        $this->session->set('role', $user->role);
    }
}