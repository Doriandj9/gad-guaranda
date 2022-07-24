<?php
namespace App\Controllers;

use App\Frame\Autentification;

class Login{
    private $autentification;
    public function __construct(
        Autentification $autentification
    )
    {
        $this->autentification= $autentification;
    }

    public function login(){
        return [
            'title' => 'Login Admin',
            'template' => 'ui/login.html.php'
        ];
    }

    public function saveLogin(){
        $res = $this->autentification->verifyLogin($_POST['cedula'],$_POST['password']);
        if($res){
            header('location: /');
            exit();
        }

        return [
            'title' => 'Login Admin',
            'template' => 'ui/login.html.php',
            'variables' => [
                'error' => 'No se ingreso correctamento los datos, pruebe nuevamente'
            ]
        ];
    }
    public function logOut(){
        unset($_SESSION);
        session_destroy();
        header('location: /');
    }
}