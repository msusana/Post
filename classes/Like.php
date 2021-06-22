<?php

class Like {

    private int $id; 
    private int $id_post; 
    private int $id_user; 
     


    
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
    public function getId_post(){
        return $this->id_post;
    }
    public function getId_User(){
        return $this->id_user;
    }
  
   
/* SET*/

    public function setId($id){
        $this->id=$id; 
    }
    public function setId_post($id_post){
        $this->id_post=$id_post; 
    }
    public function setId_user($id_user){
        $this->id_user=$id_user; 
    }

    

/*METHODE */

}