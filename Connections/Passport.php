<?php
namespace ElegenceIO\Database\Connections;

use Exception;

class Passport
{

    /**
     * Connection Registry Passport Application.
     */
    private array $required = ["main"];

    public function __construct(private array $connections=[])
    {
    }

    /**
     * public method used to register Connections
     * Method will fail if connection exists
     * @method add (string $name,array $params);
     * @see $this->hasConnection(string $name);
     * @see Exceptions
     * @return void
     */

    public function add(string $name,array $params):void
    {
        if($this->hasConnection($name))
        {
            throw new Exception("Connection $name already Exists");
        }

        // Set a connection Value;
        $this->connections[$name] = $params;
    }

    /**
     * public method used to retrieve a connection name;
     * throw Exception if Failed;
     * @param string $name;
     * @method get(string $name);
     * @return array
     */
    public function get(string $name):array
    {
        if(!$this->validateRequired())
        {
            throw new Exception("Defailt class Reqired");
        }

        if(!$this->hasConnection($name))
        {
            throw new Exception("Cannot find Connection Name");
        }

        return $this->connections[$name];
    }



    /**
     * Private method used to validate if a connection
     * @method hasConnection(string $name)
     * @param string $name
     * @return bool
     */

    private function hasConnection(string $name):bool
    {
        return (\array_key_exists($name,$this->connections)) ? true : false;
    }

    
    /**
     * private method used to validate any Required Keys are in place.
     * @method validateRequired();
     * @return bool
     */
    private function validateRequired():bool
    {
        foreach($this->required as $required){
            if(!in_array($required,$this->connections))
                {
                    throw new Exception("Connection $required cannot be found");
                }
            }
        
        return true;
    }
}