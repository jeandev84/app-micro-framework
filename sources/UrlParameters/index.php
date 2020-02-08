<?php
namespace Theory;


require_once __DIR__.'/src/Application.php';



$app = new Application();

$app->get('/', function () {

    /* $_REQUEST */
    return json_encode($_GET);
});


$app->post('/', function () {

    /* $_REQUEST */
    return json_encode($_GET);
});


$app->run();
