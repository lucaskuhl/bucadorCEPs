<?php

use MongoDB\Operation\Explain;

require '.\vendor\autoload.php';
require '.\database.php';
require '.\cep\create.php';
require '.\utils\validateCEP.php';
require '.\utils\distance.php';

$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";

$create = new createCep(['cepOrigem' => $cepOrigem, 'cepDestino' => $cepDestino]);
$validate = new validateCEP(['cepOrigem' => $cepOrigem, 'cepDestino' => $cepDestino]);

$coord = $validate->validateCep();
$distance = new distance($coord);

$d = $distance->getDistance($coord);

var_dump($d);
// $create->createCep();




// $insertOneResult = $db->insertOne([
//     'cep_destino' => '0000000',
//     'cep_origem' => '0000000',
//     'distancia' => '0000000',
// ]);

// var_dump($urlOrigem);
// var_dump($cepDestino);