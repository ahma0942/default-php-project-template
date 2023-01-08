<?php
DI::rest()->get('/ping', function() {
	http(200, 'pong!');
});

DI::rest()->get('/test', function() {
	$collection = DI::mongodb()->test->col;

	$result = $collection->insertOne(['name' => 'Ahmad', 'age' => '26', 'address' => 'Jl. Kebon Jeruk']);

	http(200, "Inserted with Object ID '{$result->getInsertedId()}'");
});
