<?php
/**
*
* An account is a company with activities and labels
*
**/
class Account
{
  private $idAccount;
  private $idNational;
  private $name;
  private $naceCode;
  private $sizeCategory;
  private $employeeCount;
  private $industry;
  private $website;
  private $city;
  private $countryCode;
  private $zipCode;
  private $lastActivityType;
  private $lastActivityDate;
  private $activities;
  private $labels;

  public function setIdAccount($idAccount) {
    $this->idAccount = $idAccount;
  }

  public function getIdAccount() {
    return $this->idAccount;
  }

  public function setIdNational($idNational) {
    $this->idNational = $idNational;
  }

  public function getIdNational() {
    return $this->idNational;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setNaceCode($naceCode) {
    $this->naceCode = $naceCode;
  }

  public function getNaceCode() {
    return $this->naceCode;
  }

  public function setSizeCategory($sizeCategory) {
    $this->sizeCategory = $sizeCategory;
  }

  public function getSizeCategory() {
    return $this->sizeCategory;
  }

  public function setEmployeeCount($employeeCount) {
    $this->employeeCount = $employeeCount;
  }

  public function getEmployeeCount() {
    return $this->employeeCount;
  }

  public function setIndustry($industry) {
    $this->industry = $industry;
  }

  public function getIndustry() {
    return $this->industry;
  }

  public function setWebsite($website) {
    $this->website = $website;
  }

  public function getWebsite() {
    return $this->website;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCountryCode($countryCode) {
    $this->countryCode = $countryCode;
  }

  public function getCountryCode() {
    return $this->countryCode;
  }

  public function setZipCode($zipCode) {
    $this->zipCode = $zipCode;
  }

  public function getZipCode() {
    return $this->zipCode;
  }

  public function setLastActivityType($lastActivityType) {
    $this->lastActivityType = $lastActivityType;
  }

  public function getLastActivityType() {
    return $this->lastActivityType;
  }

  public function setLastActivityDate($lastActivityDate) {
    $this->lastActivityDate = $lastActivityDate;
  }

  public function getLastActivityDate() {
    return $this->lastActivityDate;
  }

  public function setActivities($activities) {
    $this->activities = $activities;
  }

  public function getActivities() {
    return $this->activities;
  }

  public function setLabels($labels) {
    $this->labels = $labels;
  }

  public function getLabels() {
    return $this->labels;
  }
}
?>
