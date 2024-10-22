<?php

namespace Services;

use Interfaces\FileStorageInterface;

class FileStorage implements FileStorageInterface
{
    public function saveData($nameFile, $arr)
    {
        if (filesize($nameFile) > 0) {
            $data = $this->loadData($nameFile);
        } else
            $data = [];
        array_push($data, $arr);

        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        $handle = fopen($nameFile, "w");
        fwrite($handle, $json);
        fclose($handle);
    }
    public function loadData($nameFile): ?array
    {
        $handle = fopen($nameFile, "r");
        $data = fread($handle, filesize($nameFile));
        $arr = json_decode($data, true);
        return $arr;
    }
    
}
