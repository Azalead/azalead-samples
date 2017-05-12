<?php
/**
* Website visit referer
**/
class Referer
{
  private $idCategory;
  private $name;

  public function setIdCategory($idCategory) {
    $this->idCategory = $idCategory;
  }

  public function getIdCategory() {
    return $this->idCategory;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }
}
?>
