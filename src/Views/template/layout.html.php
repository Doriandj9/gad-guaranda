<?php

use App\Application\RoutesApplication;
use App\Frame\Autentification;
$jsonImage = file_get_contents('./src/Includes/logos.json');
$dataImage = json_decode($jsonImage,true);

$html = file_get_contents('./src/Views/template/layout.html');

$html = preg_replace('/%title%/',$title,$html);
$html = preg_replace('/%content%/',$content,$html);
$html = str_replace('% #(logo) %',$dataImage['img'],$html);
if(isset($_SESSION['user'])){
    $html = str_replace('%cam%','oculto',$html);
    $html = str_replace('% oculto %', '',$html);
}
echo $html;


