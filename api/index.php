<?php
include "vendor/autoload.php";
include "funcs/funcs.util.php";
cors();
include "envs/.env.local.php";
include "envs/.env.global.php";
include "dependencies/index.php";
include "funcs/funcs.sql.php";
include "middlewares/index.php";
include "controllers/index.php";
http(404);
