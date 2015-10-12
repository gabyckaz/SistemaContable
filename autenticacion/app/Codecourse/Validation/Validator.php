<?php

namespace Codecourse\Validation;

use Violin\Violin;
use Codecourse\User\User;

class Validator extends Violin
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user=$user;

        $this->addFieldMessages([
            'email'=>[
                'uniqueEmail'=>'Este correo ya esta en uso.'
            ],
            'username'=>[
                'uniqueUsername' => 'El usuario ya esta en uso.'
            ]
        ]);
    }

    public function validate_uniqueEmail($value,$input,$args)
    {
        $user=$this->user->where('email',$value);//busca en la base de datos si ya hay un email igual

        return ! (bool) $user->count();
    }

    public function validate_uniqueUsername($value,$input,$args)
    {

        return ! (bool) $this->user->where('username',$value)->count();
    }

}
