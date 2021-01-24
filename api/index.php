<?php
session_start();
$_SESSION['last_id'] = 0;
?>
<?php

use MongoDB\Operation\Update;

require_once '..\vendor\autoload.php';
require_once '.\database.php';
require_once '.\utils\create.php';
require_once '.\utils\read.php';
require_once '.\utils\update.php';

date_default_timezone_set('America/Sao_Paulo');


$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";
$id = isset($_GET['cep_id']) ? $_GET['cep_id'] : "";

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

        case 'update':
            $update = new updateCep($id, $cepOrigem, $cepDestino);
            var_dump($update->updateCep());
            break;
    }
}

// $coord = $validate->validateCep();
// $distance = new distance($coord);

// $d = $distance->getDistance($coord);
