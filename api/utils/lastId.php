<?php

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
