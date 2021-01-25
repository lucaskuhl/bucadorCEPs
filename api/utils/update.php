<?php

/**
 * Classe que atualiza um dado da collection usando o campo 'uid' como padrão
 */
class updateCep
{

    private $id;
    private $cepOrigem;
    private $cepDestino;


    function __construct(String $id, String $cepOrigem, String $cepDestino)
    {
        $this->id = $id;
        $this->cepOrigem = $cepOrigem;
        $this->cepDestino = $cepDestino;
    }

    public function updateCep()
    {

        $db = new Database();
        return $db->update($this->id, $this->cepOrigem, $this->cepDestino);
    }
}
