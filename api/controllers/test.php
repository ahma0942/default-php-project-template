<?php
$rest->get('/ping', function() {
	http(200, 'pong!');
});

$rest->get('/xdebug', function() {
	xdebug_break();
});
