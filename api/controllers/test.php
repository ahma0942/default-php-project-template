<?php
DI::rest()->get('/ping', function() {
	http(200, 'pong!');
});

DI::rest()->get('/test_mongo', function() {
	$collection = DI::mongodb()->test->col;

	$result = $collection->insertOne(['name' => 'Ahmad', 'age' => '26', 'address' => 'Jl. Kebon Jeruk']);

	http(200, "Inserted with Object ID '{$result->getInsertedId()}'");
});

DI::rest()->get('/test_reason_phrase', function() {
	// http(200, 'Check header in inspector', 'aljshdkjashd');
	header('HTTP/1.1 200 testing1234');
	echo "test";
	exit;
});
