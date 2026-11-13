<?php
namespace ElegenceIO\Database\Connections;
use ElegenceIO\Database\Queries\Database;
use ElegenceIO\Database\Queries\Schema;
use ElegenceIO\Database\Factorys\ConnectionRegistry;
use Exception;
use PDO;

/**
 | Connection Handler for Databse Connection.
 | Makes Connection
 | note : work out how to pass the connection and the config together.
 */
class Connection
{
    private ?PDO $pdo = null;
    public function __construct(private array $connection)
    {
        
    }

    /**
     * Thin Application layer for accessing Database Connection
     * @method get()
     * @see $this->databse->getConnection()
     * @return PDO
     */

    public function getConnection():PDO
    {
        return $this->makeConnection();
    }

    private function withConfig(string $key)
    {
        if(!array_key_exists($key,$this->connection))
        {
            throw new Exception("No Key Found");
        }
        return $this->connection[$key];
    }

    public function hasConnection()
    {
        if($this->pdo)
        {
            echo "connection found";
        }
        else
        {
            echo "No Connection Found";
        }
    }

    /**
     * Private methods
     */

    private function makeConnection():PDO
    {
        return $this->pdo ??= new PDO($this->getDsn(),$this->withConfig("username"),$this->withConfig("password"),$this->options());
    }

    private function getDsn()
    {
        return $this->withConfig("driver").":host=".$this->withConfig("hostname").";dbname=".$this->withConfig("name");
    }

    // get Database Options
    private function options():array
    {
            $options =   
            [PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
            ];

           return $options;
    }





}