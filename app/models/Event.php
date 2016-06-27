<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete;

class Event extends BaseModel
{
    public function initialize() {
        $this->belongsTo('user_id', 'User', 'id');

        $this->addBehavior(new SoftDelete([
            'field' => 'deleted',
            'value' => 1
        ]));
    }
}