<?php

require '..\vendor\autoload.php';


$client = new MongoDB\Client(
    'mongodb+srv://teste:teste@datafreteteste.a0k3t.mongodb.net/datafreteteste?retryWrites=true&w=majority');

$db = $client->datafreteteste->datafrete;

$insertOneResult = $db->insertOne([
    'cep_destino' => '0000000',
    'cep_origem' => '0000000',
    'distancia' => '0000000',
]);

var_dump($insertOneResult);
