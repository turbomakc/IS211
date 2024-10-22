<?php
namespace Services;

use Interfaces\FileStorageInterface;
use PDO;

class OrderDBStorage implements FileStorageInterface {

    const DNS = 'mysql:dbname=artem;host=localhost';

    const USER = 'root';

    const PASSWORD = '';

    private $connection;
    


    public function __construct() {
        $this->connection = new PDO(self::DNS, self::USER, self::PASSWORD);
    }
    public function saveData($nameFile, $arr)
    {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $fio= $_POST["fio"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];

            $sql = "UPDATE order SET 
            fio='{$fio}', 
            address='{$address}',
            phone='{$phone}', 
            WHERE id={$id}";

            $this->connection->exec($sql);

        }
        
        $sql = "INSERT INTO order (fio, address , phone) VALUES ('' , '' , '')";

    }

    public function loadData($nameFile): ?array
    {
    
    }
}