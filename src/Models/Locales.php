<?php

namespace App\Models;

class Locales extends DatabaseTable {
    public $id;
    public $nombre;
    public $tipo;
    public $imagen;
    public $id_locacion;
    public $id_propietario;
    public $id_usuario;

    public function __construct()
    {
        parent::__construct('locales','id','\App\Models\Locales',[
            'locales',
            'id'
        ]);
    }
}