<?php

namespace Interfaces;  
interface FileStorageInterface
{
    public function saveData($nameFile, $arr);
    public function loadData($nameFile): ?array;
}