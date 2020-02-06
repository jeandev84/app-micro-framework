<?php
namespace Theory;


/**
 * @param $url
 * @return string
*/
function server($url)
{
    if('/' === $url)
    {
        return "<p>Welcome to PHP</p>";

    } elseif ('/about' === $url) {

        return "about compagny";

    }elseif('/server' === $url) {

        echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';
    }
}

echo server($_SERVER['REQUEST_URI']);