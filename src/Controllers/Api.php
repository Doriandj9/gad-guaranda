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
    private $usuarios;
    private $locales;
    private $locacion;
    private $propietarios;
    public function __construct(
        Usuarios $usuarios,
        Locales $locales,
        Locacion $locacion,
        Propietarios $propietarios
    )
    {
        $this->usuarios = $usuarios;
        $this->locales = $locales;
        $this->locacion = $locacion;
        $this->propietarios = $propietarios;
    }
    public function documentation(){
        date_default_timezone_set('America/Guayaquil');
        $date = new \DateTime();
        $dataUser = [
            'id' => '0250186665',
            'nombre' => 'Dorian Armijos',
            'clave' => password_hash('12345',PASSWORD_DEFAULT),
            'permisos' => Usuarios::ADMINISTRADOR,
            'estado' => 'activo',
            'fecha' => $date->format('Y-m-d')
        ];
        //$this->usuarios->insert($dataUser);
        return [
            'title' => 'Login Admin',
            'template' => 'ui/documentation.html.php'
        ];
    }

    public function getAgentes(){
        header('Content-type: application/json');
        
        $agentes = $this->usuarios->getAllAgentesActivate();
        return [
            'title' => '',
            'template' => 'api/agentes.html.php',
            'variables' => [
                'agentes' => $agentes
            ]
        ];


    }

    public function getLocales(){
        header('Content-type: application/json');
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
        header('Content-type: application/json');

        $dataPropietario = [
            'cedula' => empty($_POST['cedula_propietario']) ? 'incierto' : $_POST['cedula_propietario'],
            'nombre' => empty($_POST['nombre_propietario']) ? 'incierto' : $_POST['nombre_propietario'],
            'ruc' => empty($_POST['ruc']) ? 'incierto' : $_POST['ruc'],
            'anonimo' => empty($_POST['cedula_propietario']) ? 1 : 0
        ];

        try{

            if($dataPropietario['cedula'] !== 'incierto' && strlen(trim($_POST['cedula_propietario'])) !== 10 ){
                throw new \PDOException('La cedula ingresada no contiene 10 caracteres');
            }
            $modelPropietario = null;
            $propietario = $this->propietarios->selectFromColumn('cedula',$_POST['cedula_propietario']);
            if($propietario){
                $modelPropietario = $propietario[0];
            }else{
                $modelPropietario = $this->propietarios->insertLast($dataPropietario);
            }   
        }catch(\PDOException $e){
            return [
                'title' => '',
                'template' => 'api/insertLocal.html.php',
                'variables' => [
                    'respuesta' => $res = [
                        'res' => 'Error',
                        'ident' => 0,
                        'error' => 'Error: '. $e->getMessage()
                    ]
                ]
            ];
        }  

        $dataLocales = [
            'id' => $_POST['id_local'],
            'nombre' => $_POST['nombre_local'],
            'tipo' => $_POST['tipo'],
            'imagen' => $_POST['imagen'],
            'id_locacion' => preg_split('/-/',trim($_POST['id_local']))[0],
            'id_propietario' => $modelPropietario->id,
            'id_usuario' => '1234567890'
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
        header('Content-type: application/json');
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
        header('Content-type: application/json');

        $dataLocalisacion = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
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