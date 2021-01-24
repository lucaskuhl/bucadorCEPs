<?php
require_once '..\vendor\autoload.php';
require_once './utils/distance.php';
require_once './utils/lastId.php';

class Database
{
    const MONGODB_USER = "teste";
    const MONGODB_PASSWORD = "teste";
    const MONGODB_DB_NAME = "datafreteteste";
    private $collection;

    public function __construct()
    {
        $url = "mongodb+srv://" . self::MONGODB_USER . ":" . self::MONGODB_PASSWORD . "@datafreteteste.a0k3t.mongodb.net/" . self::MONGODB_DB_NAME . "?retryWrites=true&w=majority";
        $client = new MongoDB\Client($url);
        $this->collection = $client->datafreteteste->datafrete;
    }

    public function add(array $data)
    {
        $this->collection->insertOne([
            'uid' => $data['uid'],
            'cep_origem' => $data['cep_origem'],
            'cep_destino' => $data['cep_destino'],
            'distancia' => $data['distancia'],
            'data_cadastro' => date('d/m/Y H:i:s'),
            'data_update' => ''
        ]);
        return ['action' => true];
    }

    public function read()
    {
        $rawData = $this->collection->find();
        $BsonData = new \MongoDB\Model\BSONDocument(iterator_to_array($rawData));
        $unserializedData = json_decode(json_encode($BsonData->jsonSerialize()), true);

        return ['action' => true, 'data' => json_encode($unserializedData)];
    }

    public function update(String $id, String $cepOrigem, String $cepDestino)
    {
        $distanceObj = new distanceCep();
        $distance = $distanceObj->getDistance(['cep_origem' => $cepOrigem, 'cep_destino' => $cepDestino]);
        $this->collection->findOneAndUpdate(
            ['uid' => $id],
            [
                '$set' =>
                [
                    'cep_origem' => $cepOrigem,
                    'cep_destino' => $cepDestino,
                    'distancia' => $distance,
                    'data_update' => date('d/m/Y H:i:s')
                ]
            ]
        );
        return ['action' => true];
    }

    public function delete(String $id)
    {
        $deleted = $this->collection->deleteOne(['uid' => $id]);
        return ['action' => true];
    }
}
