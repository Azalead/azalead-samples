<?php
/**
* An account has activities : website visits, ad clicked, email opened
**/
class ActivityController
{
  /**
  *  request api for account's activities
  **/
  public function requestAccountActivities($token, $account) {
    $ch = curl_init('https://api.azalead.com/latest/account/'. $account->getIdAccount().'/activity');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Token:Bearer '.$token)
    );

    $apiResults = requestAPI($ch);
    return $apiResults;
  }

  public function mapActivities($apiActivities, $afterDate, $beforeDate) {
    $activities = null;
    for ($i=0; $i < count($apiActivities) ; $i++) {
      $theDate = new DateTime();
      $theDate->setTimestamp(($apiActivities[$i]->date)/1000);
      if (inDateRange($theDate, $afterDate, $beforeDate)) {
        $activity = new activity();
        $activity->setIdActivity($apiActivities[$i]->id);
        $activity->setActivityType($apiActivities[$i]->type);
        $activity->setActivityDate($theDate);

        if (isset ($apiActivities[$i]->visitedPages)) {
          $visitedPages = $this->mapVisitedPages($apiActivities[$i]->visitedPages);
          $activity->setVisitedPages($visitedPages);
        }

        if (isset($apiActivities[$i]->referer)) {
          $referer = $this->mapReferer($apiActivities[$i]->referer);
          $activity->setReferer($referer);
        }

        if (isset($apiActivities[$i]->openers)) {
          $emailOpeners = $this->mapEmailOpeners($apiActivities[$i]->openers);
          $activity->setEmailOpeners($emailOpeners);
        }

        if (isset($apiActivities[$i]->campaignName)) {
          $activity->setCampaignName($apiActivities[$i]->campaignName);
        }

        $activities[] = $activity;
      }
    }
    return $activities;
  }

  public function mapVisitedPages($apiVisitedPages) {
    for ($i=0; $i < count($apiVisitedPages) ; $i++) {
      $visitedPage = new VisitedPage();
      $visitedPage->setIdUrl($apiVisitedPages[$i]->id);
      $visitedPage->setUrl($apiVisitedPages[$i]->url);
      $visitedPage->setDuration($apiVisitedPages[$i]->durationInSecond);
      $visitedPages[] = $visitedPage;
    }
    return $visitedPages;
  }

  public function mapEmailOpeners($apiEmailOpeners) {
    for ($i=0; $i < count($apiEmailOpeners) ; $i++) {
      $emailOpener = new EmailOpener();
      $emailOpener->setEmailAddress($apiEmailOpeners[$i]->email);
      $theDate = new DateTime();
      $theDate->setTimestamp(($apiEmailOpeners[$i]->openDate)/1000);
      $emailOpener->setOpenDate($theDate);
      $emailOpeners[] = $emailOpener;
    }
    return $emailOpeners;
  }

  public function mapReferer($apiReferer) {
    $referer = new Referer();
    $referer->setIdCategory($apiReferer->idCategory);
    $referer->setName($apiReferer->name);
    return $referer;
  }

  public function retrieveActivityTypeLabel($activityType) {
    $activityType;
    switch ($activityType) {
        case "website_visit":
            $activityType = "Website Visit";
            break;
        case "email_viewed":
            $activityType = "Email Viewed";
            break;
        case "ad_clicked":
            $activityType = "Ad Clicked";
            break;
    }
    return $activityType;
  }
}
?>
