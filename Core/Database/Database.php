<?php
namespace ElegenceIO\Database;
use ElegenceIO\Database\Connections\Connection;
use PDO;

class Database
{
    private ?PDO $pdo =null;
    public function __construct(private ?Connection $connection,private ?array $config=[])
    {    
    }

    public function get()
    {
        return $this->pdo ??= $this->connection->getConnection();
    }

}