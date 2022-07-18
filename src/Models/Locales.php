<?php

namespace App\Models;

class Locales extends DatabaseTable {
    public $id;
    public $nombre;
    public $tipo;
    public $sector;
    public $ruc;
    public $imagen;
    public $id_locacion;
    public $id_propietario;

    public function __construct()
    {
        parent::__construct('locales','id','\App\Models\Locales',[
            'locales',
            'id'
        ]);
    }
}