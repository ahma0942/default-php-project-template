<?php
$ENV = [
    'URL' => 'api.trader.localhost',
    'API' => 'api.trader.localhost',

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

$ENV['REDIS'] = [
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379
];
