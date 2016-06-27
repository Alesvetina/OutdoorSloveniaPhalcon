<?php

CONST DB_HOST = 'localhost';
CONST DB_USERNAME = 'root';
CONST DB_PASSWORD = '';
CONST DB_DATABASE = 'outdoorsloveniadb';

date_default_timezone_set('utc');

$config = new \Phalcon\Config([
    'db' => [
        'host' => DB_HOST,
        'username' => DB_USERNAME,
        'password' => DB_PASSWORD,
        'dbname' => DB_DATABASE
    ],
    'environment' => 'staging'
]);