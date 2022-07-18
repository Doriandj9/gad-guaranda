<?php

include __DIR__ . '/vendor/autoload.php';

use App\Application\RoutesApplication;
use App\Frame\EntryPoint;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
/**
 * @var $route son las rutas de la aplicacion
 */

try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');
    $entryPoint = new EntryPoint($route,$_SERVER['REQUEST_METHOD'],new RoutesApplication);
    $entryPoint->run();
} catch (\PDOException $e) {
    $err = 'Error : ' . $e->getMessage() . ' in ' . $e->getFile() . ' : ' . $e->getLine();
    echo $err;
}


