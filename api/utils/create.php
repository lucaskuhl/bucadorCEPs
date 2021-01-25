<?php

/**
 * Classe responsável por criar um cep e persisti-lo
 */
require_once '..\vendor\autoload.php';
require_once './utils/validateCEP.php';
require_once './utils/distance.php';

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

    /**
     * Calcula a distância entre os dois ceps e monta o array de dados para persistir e atualiza a listagem de ids
     * 
     * @see distance.php
     * @see lastId.php
     * @return Array
     */
    public function createCep()
    {
        $distance = new distanceCep();
        $this->distancia = $distance->getDistance(['cep_origem' => $this->cepOrigem, 'cep_destino' => $this->cepDestino]);

        $lastIdObj = new lastId();
        $lastIdObj->updateId();
        $data['uid'] = $lastIdObj->getLastId();
        $data['cep_origem'] = $this->cepOrigem;
        $data['cep_destino'] = $this->cepDestino;
        $data['distancia'] = $this->distancia . 'Km';

        $db = new Database();
        $action = $db->add($data);

        if ($action) {
            return $action;
        }
        return ['add' => false];
    }
}
