<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello-lumen', function () use ($router) {
    return '<h1>Lumen</h1><p>Hi good developer, thank for using Lumen</p>';
});


$router->get('/hello-lumen/{name}', function ($name) {
    return "<h1>Lumen</h1><p>Hi <b>" . $name . "</b>, thank for using Lumen</p>";
});

$router->get('/scores', ['middleware' => 'login', function () {
    return "<h1>Selamat</h1><p>Nilai anda 100</p>";
}]);


$router->get('users', 'UsersController@index');

$router->get('/', function () {
    return response()->json([
        'service_name' => 'PHP Service App',
        'status' => 'Running'
    ]);
});

$users = [
    [
        'id' => 1,
        'name' => 'Sumatrana',
        'email' => 'sumatrana@gmail.com',
        'address' => 'Padang',
        'gender' => 'Laki-laki'
    ],
    [
        'id' => 2,
        'name' => 'Jawarianto',
        'email' => 'jawarianto@gmail.com',
        'address' => 'Cimahi',
        'gender' => 'Laki-laki'
    ],
    [
        'id' => 3,
        'name' => 'Kalimantanio',
        'email' => 'kalimantanio@gmail.com',
        'address' => 'Samarinda',
        'gender' => 'Laki-laki'
    ],
    [
        'id' => 4,
        'name' => 'Sulawesiani',
        'email' => 'sulawesiani@gmail.com',
        'address' => 'Makasar',
        'gender' => 'Perempuan'
    ],
    [
        'id' => 5,
        'name' => 'Papuani',
        'email' => 'papuani@gmail.com',
        'address' => 'Jayapura',
        'gender' => 'Perempuan'
    ]
];

$router->get('/users', function () use (&$users) {
    return response()->json($users);
});

$router->get('/users/{userId}', function ($userId) use (&$users) {
    foreach ($users as $user) {
        if ($user['id'] == $userId) {
            return response()->json($user);
        }
    }

    return response()->json([
        'message' => 'User not found'
    ], 404);
});

$router->get('/posts', 'PostsController@index');

$router->get('/prodis', 'ProdiController@index');

$router->post('/prodis', 'ProdiController@store');
$router->get('/prodis/{id}', 'ProdiController@show');
$router->put('/prodis/{id}', 'ProdiController@update');
$router->delete('/prodis/{id}', 'ProdiController@destroy'); 

$router->get('/dosens', 'DosenController@index');
$router->post('/dosens', 'DosenController@store');

$router->get('/mahasiswas', 'MahasiswaController@index');
$router->post('/mahasiswas', 'MahasiswaController@store');

$router->get('/matakuliahs', 'MatakuliahController@index');
$router->post('/matakuliahs', 'MatakuliahController@store');

$router->get('/krs', 'KrsController@index');
$router->post('/krs', 'KrsController@store');

$router->get('/posts', 'PostsController@index');
$router->post('/posts', 'PostsController@store');
$router->get('/post/{id}', 'PostsController@show');
$router->put('/post/{id}', 'PostsController@update');
$router->delete('/post/{id}', 'PostsController@destroy');

