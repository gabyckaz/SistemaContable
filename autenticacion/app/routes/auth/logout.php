<?php

$app->get('/logout',function() use($app){

    unset($_SESSION[$app->config->get('auth.session')]);

    $app->flash('global','Has salido del sistema.');
    $app->response->redirect($app->urlFor('home'));

})->name('logout');