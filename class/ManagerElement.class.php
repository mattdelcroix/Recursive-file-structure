<?php

class ManagerElement{
  protected $_db;

  public final function __construct($db){
    $this->setDb($db);
  }

  public final function setDb(PDO $db){
    $this->_db = $db;
  }

  public final function addElement(Element $element) {

		$q = $this->_db->prepare("INSERT INTO Element (name, id_parent) VALUES (:name, :id_parent)");
		$q->bindValue(':name', $element->name());
		$q->bindValue(':id_parent', $element->id_parent());

		$q->execute();

		//Adding the id to the file object
		$element->hydrate([
			"id" => $this->_db->lastInsertId()
		]);
	}

  public final function getElements($nameFilter) {
    $array = [];
    //We set the field with upper to permit insensitive case
		$q = $this->_db->prepare("SELECT * FROM Element WHERE UPPER(name) LIKE CONCAT('%',:name,'%')");
		$q->bindValue(':name', strtoupper($nameFilter));

		$q->execute();

    while($data = $q->fetch(PDO::FETCH_ASSOC))
		{
			$array[] = new Element($data);
		}
		return $array;
	}

  public final function getElement($id){
    $q = $this->_db->prepare("SELECT * FROM Element WHERE id = :id");
    $q->bindValue(':id', $id);

    $q->execute();

    return new Element($q->fetch(PDO::FETCH_ASSOC));
  }

  public final function deleteAll(){
    $this->_db->query("TRUNCATE TABLE Element");
  }
}

?>
