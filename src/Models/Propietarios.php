<?php

namespace App\Models;

class Propietarios extends DatabaseTable{
    public $id;
    public $cedula;
    public $nombre;
    public $anonimo;

    public function __construct()
    {
        parent::__construct('propietarios','id','\App\Models\Propietario',[
            'propietarios',
            'id'
        ]);
    }
}