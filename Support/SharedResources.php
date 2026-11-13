<?php
namespace ElegenceIO\Database\Support;

use ElegenceIO\Database\Connection;
use Exception;

trait SharedResources
{
    // private ?Connection $connection = null;
    public function hasTable(string $table,string $dbname):bool|static
    {
        $sql = "SELECT 1 FROM information_schema.tables
            WHERE table_schema = :db
            AND table_name = :table";
        $params = [":db"=>$dbname,":table"=>$table];
        $results = $this->gateway->parse($sql,$params);
        return ($results->rowCount() ===1) ? $this : throw new Exception("Table Not Found");

    }


     public function onTable(?string $table=null):string
    {
              
        if(!\class_exists($table))
        {
            throw new Exception("Class Not found");
        }

        $instance = \explode("\\",$table);
        $table = end($instance);
        $table  = \preg_replace('/([a-z0-9])([A-Z])/','$1_$2',$table);
        $table = \preg_replace('/([A-Z]+)([A-Z][a-z])/','$1_$2',$table);
        return \strtolower($table);
    }

    // /**
    //  * Dynamically Change and Reset the Connections
    //  | Work on this at a later point
    //  */
    // public function on(string $connection):Connection
    // {
    //     $connection = new Connection($name);
    // }

}