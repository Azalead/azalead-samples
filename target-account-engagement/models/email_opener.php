<?php
/**
* A email campaign has email openers
**/
class EmailOpener
{
  private $emailAddress;
  private $openDate;

  public function setEmailAddress($emailAddress) {
    $this->emailAddress = $emailAddress;
  }

  public function getEmailAddress() {
    return $this->emailAddress;
  }

  public function setOpenDate($openDate) {
    $this->openDate = $openDate;
  }

  public function getOpenDate() {
    return $this->openDate;
  }
}
?>
