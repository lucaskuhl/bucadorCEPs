<?php

require '..\vendor\autoload.php';
require '.\database.php';
require '.\utils\create.php';

$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";

// $validate = new validateCEP(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            $create = new createCep(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
            var_dump($create->createCep());
            break;

        case 'read':
            $create = new createCep(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
            var_dump($create->createCep());
            break;

        default:
            # code...
            break;
    }
}

// $coord = $validate->validateCep();
// $distance = new distance($coord);

// $d = $distance->getDistance($coord);
