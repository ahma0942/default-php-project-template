<?php
$rest->get('/ping', function() {
	http(200, 'Pong');
});

$rest->get('/xdebug', function() {
	xdebug_break();
});
