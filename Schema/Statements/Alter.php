<?php
namespace ElegenceIO\Database\Schema\Statements;

class Alter
{
    public function __construct(private string $table,private array $data)
    {

    }


    private function compileAlter():string
    {
        return "";
    }
}