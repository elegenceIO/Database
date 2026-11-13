<?php
namespace ElegenceIO\Database;
use PDO,PDOStatement,PdoException;
class Gateway
{
    public function __construct(private object $connection)
    {
    }

    public function run(string $sql):PDOStatement
    {
        return $this->connection->getConnection()->prepare($sql);
    }

    public function bindParams(array $params, PDOStatement $stmt):void
    {
        foreach ($params as $key => $value) {
                $type = $this->getParamType($value);
                $stmt->bindValue($key, $value, $type);
            }
    }
    
    public function parse(string $sql,array $params=[]):PDOStatement
    {   
        // Process Query 
            $stmt = $this->run($sql);
        
            if (!empty($params)) {
            // Prepare code
            $this->bindParams($params,$stmt);
        }

            $stmt->execute();
            return $stmt;

    }

    private function getParamType(int|string|bool|null $value)
    {
    
        switch ($value) {
            case is_bool($value):
                return PDO::PARAM_BOOL;
            case is_null($value):
                return PDO::PARAM_NULL;
            case is_int($value):
                return PDO::PARAM_INT;
            case is_string($value):
                return PDO::PARAM_STR;
            default;
                break;
        }
    }

}