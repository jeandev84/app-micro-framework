<?php
namespace Theory;


require_once __DIR__ . '/src/Template.php';


use function Theory\Template\render;


/*
$app->get('/compagnies', function () {
   return '<p>compagnies list</p>';
});
*/


$html = render('views/index.phtml', [
    'site' => 'hexlet.io',
    'subprojects' => ['map.hexlet.io', 'battle.hexlet.io']
]);

echo '<pre>';
print_r($html);
echo '</pre>';
exit;