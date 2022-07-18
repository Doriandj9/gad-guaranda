<?php

namespace App\Controllers;

use App\Models\Locacion;
use App\Models\Locales;
use App\Models\Propietarios;
use App\Models\Usuarios;

/**
 * Esta clase continen todos los metodos sobre la API
 * 
 */
class Api{

    public function __construct(
        private Usuarios $usuarios,
        private Locales $locales,
        private Locacion $locacion,
        private Propietarios $propietarios
    )
    {
        $this->usuarios = $usuarios;
        $this->locales = $locales;
        $this->locacion = $locacion;
        $this->propietarios = $propietarios;
    }
    public function documentation(){
        $dataUser = [
            'id' => '0250186665',
            'nombre' => 'Dorian Armijos',
            'clave' => password_hash('12345',PASSWORD_DEFAULT),
            'permisos' => Usuarios::ADMINISTRADOR
        ];
        //$this->usuarios->insert($dataUser);
        return [
            'title' => 'Login Admin',
            'template' => 'ui/documentation.html.php'
        ];
    }

    public function getAgentes(){
        $agentes = $this->usuarios->getAllAgentes();
        return [
            'title' => '',
            'template' => 'api/agentes.html.php',
            'variables' => [
                'agentes' => $agentes
            ]
        ];


    }
    public function addAgentes(){

    }

    public function getLocales(){
        $locales = null;
        if(isset($_GET['id'])){
            $locales = $this->locales->selectFromColumn('id',$_GET['id']); 
        }else{
            $locales = $this->locales->select();
        }
        return [
            'title' => '',
            'template' => 'api/locales.html.php',
            'variables' => [
                'locales' => $locales
            ]
        ];
    }

    public function addLocales(){
        $dataLocales = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'tipo' => $_POST['tipo'],
            'sector' => $_POST['sector'],
            'ruc' => $_POST['ruc'],
            'imagen' => $_POST['imagen'],
            'id_locacion' => $_POST['locacion'],
            'id_propietario' => $_POST['id_propietario'],
            'id_usuario' => $_POST['id_usuario']
        ];
        $res = [];
        try{
            $this->locales->insert($dataLocales);
            $res = [
                'res' => 'Se inserto correctamente el local comercial',
                'ident' => 1,
                'error' => ''
            ];
        }catch(\PDOException $e){
            $res = [
                'res' => 'Error no se inserto el local comercial',
                'ident' => 0,
                'error' => $e->getMessage()
            ];
        }
        return [
            'title' => '',
            'template' => 'api/insertLocal.html.php',
            'variables' => [
                'respuesta' => $res
            ]
        ];

    }
    public function getLocaciones(){
        $locacion = null;
        if(isset($_GET['id'])){
            $locacion = $this->locacion->selectFromColumn('id',$_GET['id']);
        }else{
            $locacion = $this->locacion->select();
        }
        return [
            'title' => '',
            'template' => 'api/locacion.html.php',
            'variables' => [
                'locacion' => $locacion
            ]
        ];
    }
    public function addLocacion(){
        $dataLocalisacion = [
            'link' => $_POST['link']
        ];
        $res = [];
        try{
            $this->locacion->insert($dataLocalisacion);
            $res = [
                'res' => 'Se inserto correctamente el sector',
                'ident' => 1,
                'error' => ''
            ];
        }catch(\PDOException $e){
            $res = [
                'res' => 'Error no se inserto correctamente el sector',
                'ident' => 0,
                'error' => $e->getMessage()
            ];
        }

        return [
            'title' => '',
            'template' => 'api/insertLocacion.html.php',
            'variables' => [
                'respuesta' => $res
            ]
        ];
        
    }
}