<?php

use Slim\Slim; //con namespace para evitar confuciones
use Slim\views\Twig;
use Slim\views\TwigExtension;

use Noodlehaus\Config;

use Codecourse\User\User;
use Codecourse\Helpers\Hash;
use Codecourse\Validation\Validator;

use Codecourse\Middleware\BeforeMiddleware;

session_cache_limiter(false);//para iniciar sesiones
session_start();

ini_set('display_errors','On');//para ver los errores no en muchas paginas

define('INC_ROOT',dirname(__DIR__));//el nombre de la raiz del directorio

require INC_ROOT . '/vendor/autoload.php';//pra usar todas los paquetes de vendor

$app = new Slim([
      'mode'=>file_get_contents(INC_ROOT . '/mode.php'),
      'view'=> new Twig(),
      'templates.path' => INC_ROOT . '/app/views'
]);//inicializacion del framework

//prueba 1
//$app->get('/test/:name', function($name){//cuando entre a la url  asdfghhj/text realizar[a function]
$app->add(new BeforeMiddleware);

$app->configureMode($app->config('mode'),function() use ($app){
      $app->config=Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

//echo $app->config->get('db.driver');
require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth=false;



$app->container->set('user',function() {
    return new User;
});

$app->container->singleton('hash',function() use($app){
    return new Hash($app->config);
});

$app->container->singleton('validation', function() use($app){
    return new Validator($app->user);
});

//para debugging and more
$view = $app->view();

$view->parserOptions = [
    'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions =[
    new TwigExtension
];

/*
 * para renderizar
 * $app->get('/',function() use ($app){
    $app->render('home.php');
});*/

//echo $app->hash->password('gabriela12');
//$password = 'gabriela12';
//$hash = '$2y$10$BQGxHWLsHodAPRJkIqT8DOruXehUSWg94/BUvi2fgwx1etk.GVB/2';

//var_dump($app->hash->passwordCheck($password,$hash));



