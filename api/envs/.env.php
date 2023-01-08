<?php
$ENV = [
    'URL' => 'todo.localhost',
    'API' => 'api.todo.localhost',

    'MAILER' => [
        'HOST' => 'mail',
        'USER' => '',
        'PASS' => '',
        'PORT' => '1025',
        'MAIL' => 'info@trader.dk',
    ],
];

$ENV['ENV'] = 'LOCAL';

$ENV["DBHOST"] = "mysql";
$ENV["DBUSER"] = "trader";
$ENV["DBPASS"] = "trader";
$ENV["DBNAME"] = "trader";

$ENV['MONGODB'] = "mongodb://TODO:TODO@mongo:27017";

$ENV['REDIS'] = [
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379
];
