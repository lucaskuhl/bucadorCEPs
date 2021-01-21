<?php

class CEP
{
        public $id;
        public $cepOrigem;
        public $cepDestino;
        public $distancia = null;

        public function __construct(Array $cep = null) {
            $this->id = $cep['id'];
            $this->cepOrigem = $cep['cepOrigem'];
            $this->cepDestino = $cep['cepDestino'];
            $this->distancia = $cep['distancia'];
        }
}
