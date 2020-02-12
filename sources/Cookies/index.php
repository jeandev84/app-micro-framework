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

    return response(render('index', ['cookies' => print_r($_COOKIE, true)]));
});

$app->get('/cookie', function () {
    setcookie('session-cookie', uniqid());
    setcookie('persistent-cookie', uniqid(), time() + 10000);
    setcookie('session-cookie-with-path', uniqid(), 0, '/about');
    setcookie('session-cookie-for-domain', uniqid(), 0, '', 'www.localhost');
    setcookie('session-cookie-with-httponly', uniqid(), 0, '', '', false, true);
    return response()->redirect('/');
});

$app->run();


/* $ curl -v localhost:8080/cookie */