<?php

require '..\vendor\autoload.php';
require '.\database.php';
require '..\cep\create.php';

const CEP_ABERTO_URL = "https://www.cepaberto.com/api/v3/";
const CEP_ACCESS_TOKEN = "55e95b36b9a2a995488534ba0c63973b";

$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";

$create = new createCep(['cepOrigem' => $cepOrigem, 'cepDestino' => $cepDestino]);
$create->createCep();


// $insertOneResult = $db->insertOne([
//     'cep_destino' => '0000000',
//     'cep_origem' => '0000000',
//     'distancia' => '0000000',
// ]);

// var_dump($urlOrigem);
// var_dump($cepDestino);