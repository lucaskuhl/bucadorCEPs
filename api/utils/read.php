<?php

class readCep
{
    public function readAll()
    {
        $db = new Database();
        $action = $db->read();
        if ($action['action']) {
            return $action['data'];
        }
    }
}
