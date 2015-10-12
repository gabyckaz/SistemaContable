<?php
//config para maquina local
return [
    'app'=>[
        'url' => 'http://localhost',
        'hash' =>[
            'algo' => PASSWORD_BCRYPT,//el algoritmo 
            'cost' => 10//costo de generar el password
        ]
   ],
   'db' =>[
       'driver' =>'mysql',
       'host' => '127.0.0.1',
       'name' => 'users',
       'username' => 'root',
       'password' => 'va11008',
       'charset' => 'utf8',
       'collation' => 'utf8_unicode_ci',
       'prefix' => ''
   ],
//setting de autenticacion
    'auth' =>[
        'session'=> 'user_id',
        'remember'=> 'user_r'
     ],
    'mail' =>[
        'smtp_auth'=>true,
        'smtp_secure'=>'tls',
        'host'=>'smtp.gmail.com',
        'username'=>'gaby_dva_@hotmail.com',
        'password'=>'gabriela12',
        'port'=>587,
        'html'=>true
     ],
     'twig'=>[
         'debug'=>true
     ],
     'csrf'=>[
         'session'=>'csrf_token'
     ]
];

