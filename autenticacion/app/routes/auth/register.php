<?php

$app->get('/register',$guest(),function() use ($app){
    $app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest(),function() use($app){

    $request = $app->request;

    $email=$request->post('email');
    $username=$request->post('username');
    $password=$request->post('password');
    $passwordConfirm=$request->post('password_confirm');

    $v=$app->validation;

    $v->validate([
       'email' => [$email,'required|email|uniqueEmail'],
        'username' =>[$username,'required|alnumDash|max(20)|uniqueUsername'],//20 caract max
        'password' =>[$password,'required|min(6)'],
        'password_confirm' =>[$passwordConfirm,'required|matches(password)'],
    ]);

    if($v->passes()){
        $app->user->create([
            'email'=>$email,
            'username'=>$username,
            'password'=>$app->hash->password($password)
        ]);

        $app->flash('global','Has sido registrado');
        $app->response->redirect($app->urlFor('home'));
    }
    $app->render('auth/register.php',[
        'errors'=>$v->errors(),
        'request'=>$request,
    ]);



})->name('register.post');