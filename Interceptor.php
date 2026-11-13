<?php
namespace ElegenceIO\Database;

use ElegenceIO\Database\Queries\DbQueries;
use ElegenceIO\Database\Queries\SchemaQueries;
use ElegenceIO\Database\Orm\Statements\Select;
use ElegenceIO\Database\Orm\Statements\Update;
use ElegenceIO\Database\Orm\Statements\Delete;
use ElegenceIO\Database\Orm\Statements\Insert;
use ElegenceIO\Database\Schema\Statements\Alter;
use ElegenceIO\Database\Schema\Statements\Create;
use ElegenceIO\Database\Schema\Statements\Drop;
use Exception;

final class Interceptor
{
    public function __construct(private array $records,private string $table)
    {
    }

    private function make(Statements $statement):Statements
    {

        foreach($this->records as [$method,$params])
        {
            $statement->$method(...$params);
        }
            return $statement;
    }
    public function compile(string $layer,string $verb,array $data=[],array $context =[])
    {
        return match($layer)
        {
            "orm" => $this->make($this->compileOrm($verb,$data))->build(),
            "schema"=>$this->compileSchema($verb,$data,$context),
            default => "Invalid Layer",
        }; 
    }

    private function compileOrm(string $verb,array $data)
    {
        return match($verb)
        {
            "select" => new Select($this->table),
            "update" => new Update($this->table,$data),
            "insert" => new Insert($this->table,$data),
            "delete" => new Delete($this->table,$data),
            default => throw new Exception("Invalid Compiler chosen"),
        };
    }

    private function compileSchema(string $verb,array $data,array $context=[])
    {
        return match($verb)
        {
            "create"=> new Create($this->table,$data)->build(),
            // "alter"=> new Alter($this->table,$data)->build($context),
            "drop" => new Drop($this->table)->build(),
            default => "Invalid Request"
        };
    }
}