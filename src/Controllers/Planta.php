<?php

namespace App\Controllers;

use App\Models\Usuarios;

class Planta{
    private $usuarios;

    public function __construct(
        Usuarios $usuarios
    )
    {
        $this->usuarios = $usuarios;
    }

    
}