<?php
/**
* A website visit has visited pages
**/
class VisitedPage
{
  private $idUrl;
  private $url;
  private $duration;

  public function setIdUrl($idUrl) {
    $this->idUrl = $idUrl;
  }

  public function getIdUrl() {
    return $this->idUrl;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setDuration($duration) {
    $this->duration = $duration;
  }

  public function getDuration() {
    return $this->duration;
  }
}
?>
