<?php

class createCep
{
    public $cepOrigem;
    public $cepDestino;
    public $distancia;
    

    public function __construct(array $cep)
    {
        if ($cep['cepOrigem'] == "") {
            return http_response_code(406);
        }
        $this->cepOrigem = $cep['cepOrigem'];
        $this->cepDestino = $cep['cepDestino'];
        $this->distancia = isset($cep['distancia']) ? $cep['distancia'] : "";
    }

    public function createCep()
    {
        // $coord = $this->validateCep();

        // var_dump($this->getDistance($coord));
    }

    
}
