<?php
namespace Theory;


require_once __DIR__.'/src/Application.php';


/*
function server($url)
{
    if('/' === $url)
    {
        return "<p>Welcome to PHP</p>\n";

    } elseif ('/about' === $url) {

        return "about compagny\n";

    }elseif('/server' === $url) {

        echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';
    }
}

echo server($_SERVER['REQUEST_URI']);
*/

$routes = [
  ['/', function () {
      return "<p>main Page</p>";
  }],
  ['/sign_in', function () {
    return "you signed in";
  }],
];


$app = new Application($routes);
$app->run();
