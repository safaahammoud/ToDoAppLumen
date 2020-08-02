<?php

$router->group(['prefix' => 'api/'], function() use ($router) {
    $router->post('login/','UsersController@authenticate');
    $router->post('register/','UsersController@register');
    $router->post('todo/','TodoController@store');
    $router->get('todo/', 'TodoController@index');
    $router->get('todo/{id}/', 'TodoController@show');
    $router->put('todo/{id}/', 'TodoController@update');
    $router->delete('todo/{id}/', 'TodoController@destroy');
    $router->get('todo/{task_status_id}/filter', 'TodoController@filterByStatus');
});
