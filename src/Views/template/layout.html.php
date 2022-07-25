<?php

use App\Application\RoutesApplication;
use App\Frame\Autentification;

$html = file_get_contents('./src/Views/template/layout.html');

$html = preg_replace('/%title%/',$title,$html);
$html = preg_replace('/%content%/',$content,$html);
if(isset($_SESSION['user'])){
    $html = str_replace('%cam%','oculto',$html);
    $html = str_replace('% oculto %', '',$html);
}
echo $html;


