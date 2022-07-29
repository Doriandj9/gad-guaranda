<?php

namespace App\Controllers;

use App\Models\Locales;
use App\Models\Propietarios;
use App\Models\Usuarios;

class Planta{
    private $usuarios;
    private $locales;
    private $propietarios;

    public function __construct(
        Usuarios $usuarios,
        Locales $locales,
        Propietarios $propietarios
    )
    {
        $this->usuarios = $usuarios;
        $this->locales = $locales;
        $this->propietarios= $propietarios;
    }

    public function view($variables = []){
        

        if(isset($_GET['option']) && isset($_GET['query']) && !empty($_GET['query']))
        {
            $local = $this->locales->selectLocal(trim($_GET['option']),trim($_GET['query']));
            $variables = [
                'locales' => $local
            ];
        }
        if(empty($variables)){
            $locales = $this->locales->getAllInformation();
            $variables = [
                'locales' => $locales
            ];
        }

        return [
            'title' => 'Datos locales comerciales',
            'template' => 'ui/datosComerciales.html.php',
            'variables' => $variables
        ];

    }


    public function edit(){
        if(!isset($_GET['id'])){
            header('location: /list/locales-comerciales');
            exit();
        }

        $local = $this->locales->getLocalInformation($_GET['id']);
        return [
            'title' => 'Editar Local Comercial',
            'template' => 'ui/editLocal.html.php',
            'variables' => [
                'local' => $local
            ]
        ];
    }

    public function saveEdit(){
        $dataLocal = [
            'nombre' => $_POST['nombre_local'],
            'tipo' => $_POST['tipo']
        ];
        $dataPropietario = [
            'cedula' => $_POST['cedula'],
            'nombre' => $_POST['nombre_propietario'],
            'ruc' => $_POST['ruc'],
            'id' => $_POST['id_propietario']
        ];
        $propietarioIdent =  $this->propietarios->selectFromColumn('id',$_POST['id_propietario'])[0];  
        if($propietarioIdent->cedula !== trim($_POST['cedula'])){
            $propietarioUpdate = $this->propietarios->selectFromColumn('cedula',trim($_POST['cedula']));
            if($propietarioUpdate){
                $dataLocal['id_propietario'] = $propietarioUpdate[0]->id;

            }else{
                $dataPropietarioInsert  = [
                    'cedula' => trim($_POST['cedula']),
                    'nombre' => $_POST['nombre_propietario'],
                    'ruc' => $_POST['ruc'],
                    'anonimo' => 0
                ];
                try{
                    $modelPropietario = $this->propietarios->insertUltimate($dataPropietarioInsert); 
                    $dataLocal['id_propietario'] = $modelPropietario->id;
                }catch(\PDOException $e){
                    $locales = $this->locales->getAllInformation();
                    $variables = [
                        'locales' => $locales,
                        'error' => 'Error: ' .$e->getMessage()
                    ];
                    return $this->view($variables);
                }
            }
        }
        if(isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])){
            $imagen =$_FILES['imagen'];
            $file = base64_encode(file_get_contents($imagen['tmp_name']));
            $dataLocal['imagen']= $file; 
        }
        $dataLocal['id'] = $_POST['id_local'];

        try{
            
           $this->locales->update($dataLocal);
        }catch(\PDOException $e){
            $locales = $this->locales->getAllInformation();
            $variables = [
                'locales' => $locales,
                'error' => 'Error: ' .$e->getMessage()
            ];
            return $this->view($variables);
        }

        
        try{
            
            $this->propietarios->update($dataPropietario);
            $locales = $this->locales->getAllInformation();
             $variables = [
                 'locales' => $locales,
                 'success' => 'Se actualizo correctamente los datos'
             ];
             return $this->view($variables);

         }catch(\PDOException $e){
             $locales = $this->locales->getAllInformation();
             $variables = [
                 'locales' => $locales,
                 'error' => 'Error: ' .$e->getMessage()
             ];
             return $this->view($variables);
         }
        
    }


    
}