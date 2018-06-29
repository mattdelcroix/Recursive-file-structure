<?php

class Element {
  protected $_id;
  protected $_name;
  protected $_id_parent;

  public function __construct($data){
    if(is_Array($data)){
      $this->hydrate($data);
    }
  }

  public function hydrate($data){
    foreach($data as $key => $value)
    {
      $method = 'set' . ucfirst($key);
      if(method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

  public function id(){
    return $this->_id;
  }
  public function name(){
    return $this->_name;
  }
  public function id_parent(){
    return $this->_id_parent;
  }
  public function setId($id){
      $this->_id = (int) $id;
  }
  public function setName($name){
      $this->_name = $name;
  }
  public function setId_parent($id){
      $this->_id_parent = (int) $id;
    }
}
 ?>
