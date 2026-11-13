<?php
namespace ElegenceIO\Database;

abstract class Statements
{
    protected array $parts = [];
    protected array $bindings = [];

    abstract protected function steps():array;

    public function build(array $context = [])
    {
        $parts = [];
        foreach ($this->steps() as $step) {
            $fragment = $this->$step();
            if ($fragment !== '') $parts[] = $fragment;
        }
        
        return ["sql" => \implode(' ',$parts), "bindings" => $this->bindings];
    }


}