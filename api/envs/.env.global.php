<?php
$ENV['APP'] = 'TODO';
$ENV['ENVS'] = ['LOCAL', 'DEV', 'PROD'];

foreach ($ENV['ENVS'] as $v) {
    $ENV[$v] = $ENV['ENV'] == $v;
}
