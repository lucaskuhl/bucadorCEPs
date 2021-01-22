<?php
require '.\vendor\autoload.php';

class Database
{
    const MONGODB_USER = "teste";
    const MONGODB_PASSWORD = "teste";
    const MONGODB_DB_NAME = "datafreteteste";

    public function __construct()
    {
        $url = "mongodb+srv://" . self::MONGODB_USER . ":" . self::MONGODB_PASSWORD . "@datafreteteste.a0k3t.mongodb.net/" . self::MONGODB_DB_NAME . "?retryWrites=true&w=majority";
        $client = new MongoDB\Client($url);
        $db = $client->datafreteteste->datafrete;

        var_dump($db);
    }
}

