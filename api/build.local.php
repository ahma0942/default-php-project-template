<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('html_errors', 1);
error_reporting(E_ALL);

if (!file_exists('envs/.env.local.php') && file_exists('envs/.env.local.example.php')) {
    copy('envs/.env.local.example.php', 'envs/.env.local.php');
}

shell_exec("composer update");
shell_exec("composer install");

include "vendor/autoload.php";
include "funcs/funcs.util.php";
include "envs/.env.local.php";
include "envs/.env.global.php";
include "dependencies/index.php";
include "database/migrations.php";
include "database/seeder.php";

shell_exec("php -S 0.0.0.0:8080 index.php");
