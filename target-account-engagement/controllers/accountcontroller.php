<?php
/**
*
* An account is a company with activities and labels
*
**/
class AccountController
{
  /**
  *  request api for target accounts
  **/
  public function requestTargetAccounts($token, $page, $size) {
    $ch = curl_init('https://api.azalead.com/latest/account?page='. $page .'&size='. $size .'&target=true');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Token:Bearer '.$token)
    );

    $apiResults = requestAPI($ch);
    return $apiResults;
  }


  public function mapAccounts($apiAccounts) {
    for ($i=0; $i < count($apiAccounts) ; $i++) {
      $account = new Account();
      $account->setIdAccount($apiAccounts[$i]->id);
      $account->setIdNational($apiAccounts[$i]->idNational);
      $account->setName($apiAccounts[$i]->name);
      $account->setNaceCode($apiAccounts[$i]->naceCode);
      $account->setSizeCategory($apiAccounts[$i]->sizeCategory);
      $account->setEmployeeCount($apiAccounts[$i]->employeeCount);
      $account->setIndustry($apiAccounts[$i]->industry);
      $account->setWebsite($apiAccounts[$i]->website);
      $account->setCity($apiAccounts[$i]->city);
      $account->setCountryCode($apiAccounts[$i]->country);
      $account->setZipCode($apiAccounts[$i]->zipCode);
      $account->setLastActivityType($apiAccounts[$i]->lastActivityType);
      $theDate = new DateTime();
      $theDate->setTimestamp(($apiAccounts[$i]->lastActivityDate)/1000);
      $account->setLastActivityDate($theDate);
      $account->setLabels($apiAccounts[$i]->labels);
      $accounts[] = $account;
    }
    return $accounts;
  }
}
?>
