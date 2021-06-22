<?php

class Admin {

    private int $id; 
    private string $firstname; 
    private string $lastname; 
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
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getPassword(){
        return $this->password;
    }
   
/* SET*/

    public function setId($id){
        $this->id=$id; 
    }
    public function setFirstname($firstname){
        $this->firstname=$firstname; 
    }
    public function setLastname($lastname){
        $this->lastname=$lastname; 
    }
    public function setPassword($password){
        $this->password=$password; 
    }
    

/*METHODE */

}