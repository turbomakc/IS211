<?php
namespace Services;

use Interfaces\FileStorageInterface;
use PDO;

class ProductDBStorage implements FileStorageInterface {
    const DNS = 'mysql:dbname=artem;host=localhost';

    const USER = 'root';

    const PASSWORD = '';

    private $connection;

    public function __construct() {
        $this->connection = new PDO(self::DNS, self::USER, self::PASSWORD);
    }
    public function saveData($nameFile, $arr)
    {

    }
    public function loadData($nameFile): ?array
    {
        $sql = "SELECT * FROM product";
        $result = $this->connection->query($sql);
        $row = $result->fetchAll();
        return $row;
    }
}