<?php

namespace ElegenceIO\Database\Support;

use ElegenceIO\Database\Connection;
use ElegenceIO\Database\Database;
use PDOStatement;
use ReflectionClass;

trait CoreHelper
{
    
    protected array $attributes;
    protected array $fillable;
    protected array $gaurds;
    protected bool $exists;

    /**
     * Validate if a method exists
     * 
     */
    protected function setExists(bool $value = true):void
    {
        $this->exists = $value;
    }
    
    public function setAttributes(array $attributes):void
    {
        $this->attributes = $attributes;
    }

    /**
     * Use the following mthod to generate Unique Named paramns for sql queries
     * @param string $prefix
     * @see uniqid()
     * @return string
     */
    protected function generateParam(string $prefix,bool $moreEntropy=false): string
    {
        return uniqid($prefix . "_");
    }

    /**
     * @method setInstance()
     * @param  string $instance
     * @see end()
     * @see explode()
     * @return string
     */
    protected function setInstance(string $instance):string
    {
        $instance =  end(\explode("\\",$instance));
        return $instance;
    }

    
    public function getLastid()
    {
        return $this->lastId();
    }

   
    
    

    


}
