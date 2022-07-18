<?php

namespace App\Frame;

use App\Models\Usuarios;

class Autentification {
    
    public function __construct(
        private Usuarios $usuarios,
        private string $cedula,
        private string $password
    )
    {
        $this->usuarios = $usuarios;
        $this->cedula = $cedula;
        $this->password = $password;
        session_start();
    }

    public function verifyLogin($cedula,$password){
        $usuario = $this->usuarios->selectFromColumn('id',$cedula);
        if($usuario && password_verify($password,$usuario[0]->clave)){
            session_regenerate_id();
            $_SESSION['user'] = $usuario[0]->id;
            $_SESSION['password'] = $usuario[0]->clave;

            return true;
        }
        return false;
    }

    public function verifySession(){

        if(!isset($_SESSION['user'])){
            return false;
        }

        $user = $this->usuarios->selectFromColumn('id',$_SESSION['user'])[0];
        if($user && $user->clave === $_SESSION['password']){
            return true;
        }
        return false;
    }

    public function getUser(){
        if(!$this->verifySession()){
           return false;
        }
        $user = $this->usuarios->selectFromColumn('id',$_SESSION['user'])[0];
        return $user;
    }


}