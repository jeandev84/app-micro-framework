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

    /** @var array */
    private $handlers;


    /**
     * Application constructor.
     * @param array $routes
     */
    public function __construct(?array $routes)
    {
        $this->routes = $routes;
    }


    /**
     * @param $route
     * @param $handler
    */
    public function get($route, $handler)
    {
         $this->append('GET', $route, $handler);
    }


    /**
     * @param $route
     * @param $handler
    */
    public function post($route, $handler)
    {
        $this->append('POST', $route, $handler);
    }



    /**
     * Run Application
    */
    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->handlers as $item)
        {
            list($route, $handlerMethod, $handler) = $item;
            $preparedRoute = str_replace('/', '\/',$route);
            $matches = [];

            if($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri, $matches))
            {
                $arguments = array_filter($matches, function ($key) {
                     return ! is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                echo $handler($_GET, $arguments);
            }
        }
    }


    /**
     * @param $method
     * @param $route
     * @param $handler
    */
    private function append($method, $route, $handler)
    {
        /* $this->routes[$method][$route] = $handler; */
        /* $this->handlers[] = compact('method', 'route', 'handler'); */
        $this->handlers[] = [
          'route' => $route,
          'handlerMethod' => $method,
          'handler' => $handler
        ];
    }
}