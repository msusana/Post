<?php

class Post {

    private int $id; 
    private string $name_post; 
    private string $description; 
    private string $link; 
    private $created; 
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
    public function getName_post(){
        return $this->name_post;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getLink(){
        return $this->link;
    }
    public function getCreated(){
        return $this->created;
    }
    public function getId_user(){
        return $this->id_user;
    }
   
/* SET*/

    public function setId($id){
        $this->id=$id; 
    }
    public function setName_post($name_post){
        $this->name_post=$name_post; 
    }
    public function setDescription($description){
        $this->description=$description; 
    }
    public function setLink($link){
        $this->link=$link; 
    }
    public function setCreated($created){
        $this->created=$created; 
    }
    public function setId_user($id_user){
        $this->id_user=$id_user; 
    }
    

/*METHODE */

}