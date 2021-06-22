<?php

class Review {

    private int $id; 
    private string $text_review;
    private int $id_user;
    private int $id_post;
    private $created; 
    private $time;
     


    
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
    public function getText_review(){
        return $this->text_review;
    }
    public function getCreated(){
        return $this->created;
    }
    public function getTime(){
        return $this->time;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function getId_post(){
        return $this->id_post;
    }
/* SET*/

    public function setId($id){
        $this->id=$id; 
    }
    public function setText_review($text_review){
        $this->text_review=$text_review; 
    }
    public function setCreated($created){
        $this->created=$created; 
    }
    public function setId_user($id_user){
        $this->id_user=$id_user; 
    }
    public function setId_post($id_post){
        $this->id_post=$id_post; 
    }
    public function setTime($time){
        $this->time=$time; 
    }
    

/*METHODE */

}