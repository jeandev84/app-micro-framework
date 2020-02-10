<?php
namespace Theory;


require_once __DIR__.'/src/Application.php';

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

    /* $email = trim($user['email']); */
    if(! $user['email'])
    {
        $errors['email'] = "Email can't be blank";
    }elseif(! filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valid";
    }


    if(empty($errors))
    {
        $repository->insert($user);
        return response()->redirect('/');
    }else{
        return response(render('users/new', ['user' => $user, 'errors' => $errors]))
               ->withStatus(422); /* code problem with validation */
    }
});


$app->run();
