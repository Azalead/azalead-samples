<?php
/**
* Api Error is an error from the api
**/
class ApiError
{
  private $title;
  private $status;
  private $detail;

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setDetail($detail) {
    $this->detail = $detail;
  }

  public function getDetail() {
    return $this->detail;
  }
}
?>
