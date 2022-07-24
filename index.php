<?php

include __DIR__ . '/autoload.php';

use App\Application\RoutesApplication;
use App\Application\Utiles;
use App\Frame\EntryPoint;

Utiles::loadEnv(__DIR__);
try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');
    $entryPoint = new EntryPoint($route,$_SERVER['REQUEST_METHOD'],new RoutesApplication);
    $entryPoint->run();
} catch (\PDOException $e) {
    $err = 'Error : ' . $e->getMessage() . ' in ' . $e->getFile() . ' : ' . $e->getLine();
    echo $err;
}


