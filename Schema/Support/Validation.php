<?php
namespace ElegenceIO\Database\Schema\Support;

use ElegenceIO\Database\Orm\Statements\Statement;

trait Validation
{

    /**
     * Validate colum against array
     * @return bool
     * protected @method validateColumn()
     * @param ?string $column=null
     *
     */
     protected function validateColumn(?string $column=null):bool
    {
        $column ??= $this->currentColumn;
        
        return (array_key_exists($column,$this->columns)) ? true : false;
    }


    /**
     * protected @method validateStatement
     * @param string $colum
     */
    protected function validateStatement(string $column):bool
    {
        return \array_key_exists($column,$this->statements) ? true : false;
    }

    
}