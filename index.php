<?php
namespace Theory;

/* https://prog-cpp.ru/uml-classes/ */

use function Theory\FileUpload\codeToMessage;


require_once __DIR__.'/src/Application.php';
require_once __DIR__.'/src/Response.php';
require_once __DIR__.'/src/Template.php';
/* require_once __DIR__.'/src/Renderer.php'; */
require_once __DIR__.'/src/FileUpload.php';


/*
use function App\response;
use function App\Renderer\render;
*/

# Create new application
$app = new Application();


$app->get('/', function (){
     session_start();
    return response(print_r($_SESSION, true));
});

$app->get('/session/new', function ($meta, $params) {
    session_start();
    $_SESSION = $params;
    return response()->redirect('/');
});


$app->get('/session/destroy', function ($meta, $params) {
    session_start();
    session_destroy();
    return response()->redirect('/');
});

$app->run();


/* $ curl -v localhost:8080/cookie */