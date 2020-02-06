<?php
namespace Theory;


/**
 * Class Application
 * @package Theory
*/
class Application
{

    /** @var array */
    private $routes;


    /**
     * Application constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }


    /**
     * Run Application
    */
    public function run()
    {
        /* REQUEST METHOD */
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $item)
        {
            list($route, $handler) = $item;
            $preparedRoute = preg_quote($route, '/');
            if(preg_match("/^$preparedRoute$/i", $uri))
            {
                echo $handler();
                return;
            }
        }
    }
}