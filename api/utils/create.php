<?php

require '..\vendor\autoload.php';
require './utils/validateCEP.php';
require './utils/distance.php';

class createCep
{
    private $cepOrigem;
    private $cepDestino;
    private $distancia;


    public function __construct(array $cep)
    {

        $this->cepOrigem = $cep['cep_origem'];
        $this->cepDestino = $cep['cep_destino'];
        $this->distancia = "";
    }

    public function createCep()
    {
        $validate = new validateCEP();
        $validCep = $validate->validateCep(['cep_origem' => $this->cepOrigem, 'cep_destino' => $this->cepDestino]);
        if (!$validCep['cep_origem'] || !$validCep['cep_destino']) {
            return ['cep_origem' => false, 'cep_destino' => false];
        }
        $distance = new Distance();
        $this->distancia = $distance->getDistance($validCep);

        $data['cep_origem'] = $this->cepOrigem;
        $data['cep_destino'] = $this->cepDestino;
        $data['distancia'] = $this->distancia;

        $db = new Database();
        $action = $db->add($data);

        if ($action) {
            return $action;
        }
        return ['add' => false];
    }
}
