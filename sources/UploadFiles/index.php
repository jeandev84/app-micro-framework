<?php
namespace Theory;

/* https://prog-cpp.ru/uml-classes/ */

use function Theory\FileUpload\codeToMessage;

require_once __DIR__.'/src/Application.php';
require_once __DIR__.'/src/Response.php';
require_once __DIR__.'/src/Template.php';
require_once __DIR__.'/src/FileUpload.php';


# Create new application
$app = new Application();

$options = [
  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
  \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];

$pdo = new \PDO('sqlite:db.sqlite', null, null, $options);
$repository = new UserRepository($pdo);

$newUser = [
  'email' => '',
  'first_name' => ''
];


# show all users
$app->get('/users', function () use ($repository){

    $users = $repository->all();
    return response(render('users/index', compact('users')));
});


# show form (create user)
$app->get('/users/new', function ($meta, $params, $attributes) use ($newUser) {

    return response(render('users/new', ['errors' => [], 'user' => $newUser]));
});


# send form (send)
$app->post('/users', function ($meta, $params, $attributes) use ($repository) {
    $user = $params['user'];
    $errors = [];

    # verify if key 'user' exist in array $_FILES
    if(array_key_exists('user', $_FILES))
    {
        error_log(print_r($_FILES, true));

        # unique key upload
        $key = 'avatar';

        # get error code
        $errorCode = $_FILES['user']['error'][$key];

        if($errorCode !== UPLOAD_ERR_NO_FILE)
        {
            if($errorCode !== UPLOAD_ERR_OK)
            {
                $errors['avatar'] = codeToMessage($errorCode);

            }else{

                $tmpName = $_FILES["user"]["tmp_name"][$key];
                $name = $_FILES["user"]["name"][$key];
                $newName = 'images'. DIRECTORY_SEPARATOR . $name;

                if(! move_uploaded_file($tmpName, $newName))
                {
                    $errors['avatar'] = 'Something was wrong';
                }else{
                    $errors['avatar'] = $name;
                }
            }
        }
    }

    error_log(print_r($_FILES, true));

});


$app->run();
