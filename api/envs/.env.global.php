<?php
$ENV['APP'] = 'TODO';
$ENV['ENVS'] = ['LOCAL', 'TEST', 'STAGING', 'PROD'];

foreach ($ENV['ENVS'] as $v) {
    $ENV[$v] = $ENV['ENV'] == $v;
}
