<?php
namespace Theory\Template;


/**
 * Class View
 * @package Theory\Template
 */
class View
{

    /** @var string|string  */
    private $templatePath;


    /**
     * View constructor.
     * @param string $templatePath
     */
    public function __construct(string $templatePath)
    {
        $this->templatePath = rtrim($templatePath, '/');
    }


    /**
     * @param string $template
     * @param array $variables
     * @return false|string
    */
    function render(string $template, array $variables = [])
    {
        extract($variables);
        ob_start();
        @include $this->templatePath . DIRECTORY_SEPARATOR . ltrim($template, '/');
        return ob_get_clean();
    }
}



/**
 * @param string $template
 * @param array $variables
 * @return false|string
*/
function render(string $template, array $variables = [])
{
    $viewObject = new View(__DIR__.'/views/');
    $viewObject->render($template, $variables);
}


/*
Testing view
$viewObject = new View(__DIR__.'/views/');
$viewObject->render('index.php', [
    'title' => 'List',
    'users' => ['user1', 'user2', 'user3', 'user4']
]);
*/
