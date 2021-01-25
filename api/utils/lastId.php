<?php

/**
 * Classe criada com o objetivo de prover um suporte simples a criação de novos itens no banco
 * Por algum motivo desconhecido tanto a dll de extensão do mongoDB, quanto a biblioteca indicada no site
 * não implementam a classe MongoDB\BSON que seria utilizada para gerenciamento dos IDs.
 */

class lastId
{
    public function getLastId()
    {
        $filename = "./utils/lastId.txt";
        $file = fopen($filename, "r");

        if ($file == false) {
            echo ("Error in opening file");
            exit();
        }

        $filesize = filesize($filename);
        $filetext = fread($file, $filesize);
        fclose($file);

        return $filetext;
    }

    public function updateId()
    {
        $filename = "./utils/lastId.txt";
        $file = fopen($filename, "r");

        if ($file == false) {
            echo ("Error in opening file");
            exit();
        }

        $filesize = filesize($filename);
        $filetext = fread($file, $filesize);
        fclose($file);

        $lastId = intval($filetext);
        $lastId += 1;

        $file = fopen($filename, "w");

        if ($file == false) {
            echo ("Error in opening new file");
            exit();
        }
        fwrite($file, $lastId);
        fclose($file);
    }
}
