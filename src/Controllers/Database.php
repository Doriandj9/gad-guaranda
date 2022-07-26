<?php

namespace App\Controllers;

use App\Frame\Autentification;


class Database{
    private $autentification;

    public function __construct(
        Autentification $autentification
    )
    {
        $this->autentification = $autentification;
    }

    public function view(){
        $user = $this->autentification->getUser();
        return [
            'title' => 'Respaldos de bases de Datos',
            'template' => 'ui/respaldos.html.php',
            'variables' => [
                'user' => $user
            ]
        ];
    }

    public function generate(){
        date_default_timezone_set('America/Guayaquil');
        $date = new \DateTime();
        $nombre = $date->getTimestamp() . '-backup.sql';
        $dir = __DIR__ . '/../backups/';
        $output = $dir . $nombre;
        $sentencia = 'mysqldump -h ' . $_ENV['HOST'] . ' -u ' . $_ENV['USER'] . ' -p ' . $_ENV['PASSWORD'] . ' --opt '
        . $_ENV['DBNAME'] . ' > ' . $output;
        

        system($sentencia,$output);
       header('location: /list/respaldos/db');
    }

    public function list(){
        
        return [
            'title' => 'Lista de Respaldos',
            'template' => 'ui/listRespaldos.html.php',
        ];
    }
}