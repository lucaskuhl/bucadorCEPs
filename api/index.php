<?php

require '..\vendor\autoload.php';
require '.\database.php';
require '.\utils\create.php';
require '.\utils\read.php';

date_default_timezone_set('America/Sao_Paulo');


$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            $create = new createCep(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
            var_dump($create->createCep());
            break;

        case 'read':
            $read = new readCep();
            var_dump($read->readAll());
            break;

        default:
            # code...
            break;
    }
}

// $coord = $validate->validateCep();
// $distance = new distance($coord);

// $d = $distance->getDistance($coord);
