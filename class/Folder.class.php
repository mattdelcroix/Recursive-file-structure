<?php
class Folder extends Element{

    //construtor
    public function __construct($data){
      if(is_Array($data)){
        $this->hydrate($data);
      }
    }

    public function hydrate($data){
      foreach($donnees as $key => $value)
  		{
  			$method = 'set' . ucfirst($key);
  			if(method_exists($this, $method))
  			{
  				$this->$method($value);
  			}
  		}
    }
}
?>
