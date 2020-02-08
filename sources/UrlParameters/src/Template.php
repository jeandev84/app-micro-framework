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
        $this->templatePath = $templatePath;
    }


    /**
     * @param string $template
     * @param array $variables
     * @return false|string
     */
    function render(string $template, array $variables)
    {
        extract($variables);
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $template;
        return ob_get_clean();
    }
}



/**
 * @param string $template
 * @param array $variables
 * @return false|string
 */
function render(string $template, array $variables)
{
    extract($variables);
    ob_start();
    include $template;
    return ob_get_clean();
}


$viewObject = new View(__DIR__.'/views/');
$viewObject->render('index.php', [
    'title' => 'List',
    'users' => ['user1', 'user2', 'user3', 'user4']
]);