<?php

class TempUser {

    /** @var array $data **/
    private $data;

    /** @var bool $connected_state */
    public $connected_state = false;
    
    public function __construct(array $data){
        $this->data = $data;
    }
    
    /**
     * @return string
     */
    public function getUsername() : string {
        return $this->data["username"];
    }
    
    /**
     * @return string
     */
    public function getPassword() : string {
        return $this->data["password"];
    }
    
    /**
     * @return int
     */
    public function getId() : int {
        return $this->data["id"];
    }

    public function connect(){
        $this->connected_state = true;
        SqlManager::writeData("INSERT INTO connected(
            name
        ) VALUES (
            '" . $this->getUsername() . "'
        )", SqlManager::DATABASE_OLYMPUS);
    }

    public function disconnect(){
        $this->connected_state = false;
        SqlManager::writeData("DELETE FROM `connected` WHERE
            `name` = '" . $this->getUsername() . "'",
        SqlManager::DATABASE_OLYMPUS);
    }
}