<?php

namespace App\Controllers;

use App\Models\Usuarios;

class Agentes {
    private $agentes;
    public function __construct(
       Usuarios $agentes
    )
    {
        $this->agentes = $agentes;
    }

    public function view($variables=[]){
        if(empty($variables)){
            return [
                'title' => 'Ingresar un Agente',
                'template' => 'ui/agentes.html.php'
            ];
        }
        
        return [
            'title' => 'Ingresar un Agente',
            'template' => 'ui/agentes.html.php',
            'variables' => $variables
        ];
    }

    public function saveAgente(){
        if(empty($_POST['cedula']) ||
            empty($_POST['nombre']) ||
            empty($_POST['password'])
        ){
            return $this->view([
                'error' => 'Uno de los campos no ingreso'
            ]);
        }
        $dataAgentes = [
            'id' => $_POST['cedula'],
            'nombre' => $_POST['nombre'],
            'clave' => base64_encode($_POST['password']),
            'permisos' => Usuarios::AGENTE_MUNICIPAL
        ];
        
        try{
            $this->agentes->insert($dataAgentes);
            return $this->view([
                'success' => 'Se guardo correctamente al agente' 
            ]);
        }catch(\PDOException $e){
            return $this->view([
                'error' => 'Error no se pudo guardar por ' . $e->getMessage() 
            ]);
        }
    }
    public function list(){
        $agentes =  $this->agentes->selectFromColumn('permisos',Usuarios::AGENTE_MUNICIPAL);
        return [
            'title' => 'Lista de Agentes',
            'template' => 'ui/listAgentes.html.php',
            'variables' => [
                'agentes' => $agentes
            ]
        ];
    }
    public function removeAgente(){
        $agentes =  $this->agentes->selectFromColumn('permisos',Usuarios::AGENTE_MUNICIPAL);
        return [
            'title' => 'Lista de Agentes',
            'template' => 'ui/removeAgentes.html.php',
            'variables' => [
                'agentes' => $agentes
            ]
        ];
        
    }
}