<?php

class User {

    private int $id; 
    private string $nickname; 
    private string $password;

    
    public function __construct(array $data)
    {
      $this->hydrate($data);
    }
   
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
          $method = 'set'.ucfirst($key);
          
          if (method_exists($this, $method))
          {
            $this->$method($value);
          }
        }
      }

    /* GET */  
    public function getId(){
        return $this->id;
    }
    public function getNickname(){
        return $this->nickname;
    }
    public function getPassword(){
        return $this->password;
    }
   
/* SET*/

    public function setId($id){
        $this->id=$id; 
    }
    public function setNickname($nickname){
        $this->nickname=$nickname; 
    }
    
    public function setPassword($password){
        $this->password=$password; 
    }
    

/*METHODE */

}