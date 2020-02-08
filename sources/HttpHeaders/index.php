<?php
namespace Theory;


require_once __DIR__.'/src/Application.php';



$app = new Application();

$app->get('/', function ($params, $arguments) {
    return 'Hello, world!';
});


$app->get('/sign_in', function ($params, $arguments) {

    $headers = getallheaders(); /* $_SERVER */
    error_log(print_r($_SERVER, true));
    http_response_code(302);
    header("Location: http://localhost:8080");

    return print_r($headers, true);
});


$app->run();
