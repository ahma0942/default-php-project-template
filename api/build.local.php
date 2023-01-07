<?php
shell_exec("php composer update");
shell_exec("php composer install");

shell_exec("php swagger/build_swagger.php");

shell_exec("php -S 0.0.0.0:8080");
