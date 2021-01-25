<?php

/**
 * Classse para deletar um CEP, apenas deleta por ID
 */
class deleteCep
{
    private $id;

    function __construct(String $id)
    {
        $this->id = $id;
    }

    public function deleteCep()
    {
        $db = new Database();
        return $db->delete($this->id);
    }
}
