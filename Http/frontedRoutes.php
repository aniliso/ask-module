<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>''], function (Router $router) {
    $router->get('/doktora-sor', [
        'uses' => 'PublicController@create',
        'as'   => 'ask.question.create'
    ]);
    $router->post('/doktor/soru/ekle', [
        'uses' => 'PublicController@store',
        'as'   => 'ask.question.store'
    ]);
});