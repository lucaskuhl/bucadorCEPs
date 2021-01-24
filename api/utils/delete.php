<?php

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
        $db->delete($this->id);
    }
}
