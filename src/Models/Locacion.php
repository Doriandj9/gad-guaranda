<?php

namespace App\Models;

class Locacion extends DatabaseTable{
    public $id;
    public $link;

    public function __construct()
    {
        parent::__construct('locacion','id','\App\Models\Locacion',[
            'locacion',
            'id'
        ]);
    }
}