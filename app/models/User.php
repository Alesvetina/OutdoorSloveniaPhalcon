<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete,
    \Phalcon\Security;
use \Phalcon\Validation;
use \Phalcon\Validation\Validator\Email as EmailValidator;
use \Phalcon\Validation\Validator\Uniqueness as Uniqueness;

class User extends BaseModel
{
    public function initialize() {
        $this->hasMany('id', 'Event', 'user_id');

        $this->addBehavior(new SoftDelete([
            'field' => 'deleted',
            'value' => 1
        ]));
    }

    public function getRegisterForm(){
        return [
            'username' => [
                'title' => 'Username',
                'required' => true
            ],
            'email' => [
                'title' => 'Email',
                'type' => 'email',
                'required' => true
            ],
            'first_name' => [
                'title' => 'First Name'
            ],
            'last_name' => [
                'title' => 'Last Name'
            ],
            'address' => [
                'title' => 'Address'
            ],
            'postal_code' => [
                'title' => 'Postal Code',
                'type' => 'number'
            ],
            'city' => [
                'title' => 'City'
            ],
            'token' => [
                'type' => 'hidden',
                'name' => $this->getDI()->get('security')->getTokenKey(),
                'value' => $this->getDI()->get('security')->getToken()
            ]
        ];
    }

    public function validation() {
        $validator = new Validation();
        $validator->add(
            'email',
            new EmailValidator([
                'message' => 'Your email is invalid'
            ])
        );
        $validator->add(
            'email',
            new Uniqueness([
                'message' => 'The email is already taken'
            ])
        );
        $validator->add(
            'username',
            new Uniqueness([
                'message' => 'The username is already taken'
            ])
        );

        if($this->validationHasFailed()) {
            return false;
        }

        $security = new Security();
        $this->password = $security->hash($this->password);
    }
}