<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ask'], function (Router $router) {
    $router->bind('question', function ($id) {
        return app('Modules\Ask\Repositories\QuestionRepository')->find($id);
    });
    $router->get('questions', [
        'as' => 'admin.ask.question.index',
        'uses' => 'QuestionController@index',
        'middleware' => 'can:ask.questions.index'
    ]);
    $router->get('questions/create', [
        'as' => 'admin.ask.question.create',
        'uses' => 'QuestionController@create',
        'middleware' => 'can:ask.questions.create'
    ]);
    $router->post('questions', [
        'as' => 'admin.ask.question.store',
        'uses' => 'QuestionController@store',
        'middleware' => 'can:ask.questions.create'
    ]);
    $router->get('questions/{question}/edit', [
        'as' => 'admin.ask.question.edit',
        'uses' => 'QuestionController@edit',
        'middleware' => 'can:ask.questions.edit'
    ]);
    $router->put('questions/{question}', [
        'as' => 'admin.ask.question.update',
        'uses' => 'QuestionController@update',
        'middleware' => 'can:ask.questions.edit'
    ]);
    $router->delete('questions/{question}', [
        'as' => 'admin.ask.question.destroy',
        'uses' => 'QuestionController@destroy',
        'middleware' => 'can:ask.questions.destroy'
    ]);
// append

});
