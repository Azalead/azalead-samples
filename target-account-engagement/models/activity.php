<?php
/**
* An account has activities : website visits, ad clicked, email opened
**/
class Activity
{
  private $idActivity;
  private $activityType;
  private $activityDate;
  private $visitedPages;
  private $referer;
  private $emailOpeners;
  private $campaignName;

  public function setIdActivity($idActivity) {
    $this->idActivity = $idActivity;
  }

  public function getIdActivity() {
    return $this->idActivity;
  }

  public function setActivityType($activityType) {
    $this->activityType = $activityType;
  }

  public function getActivityType() {
    return $this->activityType;
  }

  public function setActivityDate($activityDate) {
    $this->activityDate = $activityDate;
  }

  public function getActivityDate() {
    return $this->activityDate;
  }

  public function setVisitedPages($visitedPages) {
    $this->visitedPages = $visitedPages;
  }

  public function getVisitedPages() {
    return $this->visitedPages;
  }

  public function setReferer($referer) {
    $this->referer = $referer;
  }

  public function getReferer() {
    return $this->referer;
  }

  public function setEmailOpeners($emailOpeners) {
    $this->emailOpeners = $emailOpeners;
  }

  public function getEmailOpeners() {
    return $this->emailOpeners;
  }

  public function setCampaignName($campaignName) {
    $this->campaignName = $campaignName;
  }

  public function getCampaignName() {
    return $this->campaignName;
  }
}
?>
