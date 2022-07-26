<?php

namespace App\Models;

class Usuarios extends DatabaseTable{
    public $id;
    public $nombre;
    public $clave;
    public $permisos;
    public $estado;
    public $fecha;
    public const AGENTE_MUNICIPAL = 1;
    public const JEFE_PLANTA = 4;
    public const ADMINISTRADOR = 6;

    public function __construct()
    {
        parent::__construct('usuarios','id','\App\Models\Usuarios',[
            'usuarios',
            'id'
        ]);
    }

    public function getAllAgentes(){
        return $this->selectFromColumn('permisos',self::AGENTE_MUNICIPAL); // Regresa solo los agentes municipales
    }


    public function hasPermission($permission){

        return $this->permisos & $permission;
    }
}