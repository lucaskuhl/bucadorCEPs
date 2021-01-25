<?php

require_once '..\vendor\autoload.php';
require_once '.\database.php';
require_once '.\utils\create.php';
require_once '.\utils\read.php';
require_once '.\utils\update.php';
require_once '.\utils\delete.php';
require_once '.\utils\validateCEP.php';

date_default_timezone_set('America/Sao_Paulo');


$cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : "";
$cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : "";
$id = isset($_GET['cep_id']) ? $_GET['cep_id'] : "";

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            $create = new createCep(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
            echo json_encode($create->createCep());
            break;

        case 'read':
            $read = new readCep();
            echo json_encode($read->readAll());
            break;

        case 'update':
            $update = new updateCep($id, $cepOrigem, $cepDestino);
            echo json_encode($update->updateCep());
            break;

        case 'delete':
            $delete = new deleteCep($id);
            echo json_encode($delete->deleteCep());
            break;

        case 'validate':
            $validate = new validateCEP();
            $validCep = $validate->validateCep(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
            echo json_encode($validCep);
            break;

        default:
            header("HTTP/1.0 404 Not Found");
            break;
    }
}
