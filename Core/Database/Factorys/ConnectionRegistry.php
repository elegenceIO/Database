<?php
namespace ElegenceIO\Database\Factorys;

abstract class ConnectionRegistry
{
    private static array $connection = [];
    
    /**
     * Connection Registry File
     * @param array $connection
     * @return void
     */
    public static function Register(array $connection):void
    {
        self::$connection = $connection;
    }

    /**
     * Getter for Database connection can be called without passing a connection file;
     * @return array
     */
    public static function fetch():array
    {
        return self::$connection;
    }

    
}