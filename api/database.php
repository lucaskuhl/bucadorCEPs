<?php
require '..\vendor\autoload.php';

class Database
{
    const MONGODB_USER = "teste";
    const MONGODB_PASSWORD = "teste";
    const MONGODB_DB_NAME = "datafreteteste";
    private $client;

    public function __construct()
    {
        $url = "mongodb+srv://" . self::MONGODB_USER . ":" . self::MONGODB_PASSWORD . "@datafreteteste.a0k3t.mongodb.net/" . self::MONGODB_DB_NAME . "?retryWrites=true&w=majority";
        $this->client = new MongoDB\Client($url);
    }

    public function add(array $data)
    {
        $db = $this->client->datafreteteste->datafrete;
        $db->insertOne([
            'cep_origem' => $data['cep_origem'],
            'cep_destino' => $data['cep_destino'],
            'distancia' => $data['distancia'],
            'data_cadastro' => date('d/m/Y H:i:s'),
            'data_update' => ''
        ]);
        return ['add' => true];
    }
}
