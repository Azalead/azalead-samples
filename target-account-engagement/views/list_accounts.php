<?php
session_start();

require_once('../controllers/accountcontroller.php');
require_once('../controllers/activitycontroller.php');
require_once('../controllers/labelcontroller.php');
require_once('../helpers/functions.php');
require_once('../models/api_error.php');
require_once('../models/api_result.php');
require_once('../models/account.php');
require_once('../models/activity.php');
require_once('../models/visited_page.php');
require_once('../models/email_opener.php');
require_once('../models/referer.php');
require_once('../models/label.php');


if (isset($_SESSION["user_token"]) && $_SESSION["user_token"] != null) {
  $accountController = new AccountController();
  $activityController = new ActivityController();
  $labelController = new LabelController();

  // YESTERDAY
  $afterDate = new DateTime();
  $afterDate->setTimestamp(strtotime("-1 day, midnight"));
  // NOW
  $beforeDate = new DateTime();
  $beforeDate->setTimestamp(strtotime("now"));

  $startPage = 1;
  $nbResults = 10;

  $apiLabelResults = $labelController->requestLabels($_SESSION["user_token"]);
  $apiLabels = $apiLabelResults->getResults();
  $labels = $labelController->mapLabels($apiLabels);

  $apiResults = $accountController->requestTargetAccounts($_SESSION["user_token"], $startPage, $nbResults);
  $apiError = $apiResults->getApiError();

  $apiAccounts = $apiResults->getResults();
  $accounts = $accountController->mapAccounts($apiAccounts);

  for($i = 0; $i < count($accounts); $i++){
    $apiReqActivities = $activityController->requestAccountActivities($_SESSION["user_token"], $accounts[$i]);
    $apiActivityError = $apiReqActivities->getApiError();
    if ($apiError == null) {
      $apiActivities = $apiReqActivities->getResults();
      // Get activities from yesterday for this account
      $activities = $activityController->mapActivities($apiActivities, $afterDate, $beforeDate);
      if ($activities != null) {
        $accounts[$i]->setActivities($activities);
      }
    }
  }
} else {
  header('Location: ../index.php');
}
?>
<html>
  <head>
    <title>Accounts</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="main-content">
      <h1>Accounts</h1>
<?php
if (isset($apiError) && ($apiError != null)) {
    echo 'Status code: ' . $apiError->getStatus() . '<br/>';
    echo 'Title: ' . $apiError->getTitle() . '<br/>';
    echo $apiError->getDetail() . '<br/>';
} else {
        date_default_timezone_set('UTC');
        for($i = 0; $i < count($accounts); $i++){
          echo '<div style="padding:20px;">';
          echo '<h1>' . $accounts[$i]->getName().'</h1><br/><br/>';
          echo 'ID: '.$accounts[$i]->getIdAccount().'<br/>';
          echo 'ID National: '.$accounts[$i]->getIdNational().'<br/>';

          $accountLabels = $accounts[$i]->getLabels();
          $accountLabels1 = $accounts[$i]->getLabels();
          $accountLabelsCount = count($accountLabels);

          $labelNames = '';
          for($l = 0; $l < count($accountLabels); $l++){
            $labelName = $labelController->findLabelName($accountLabels[$l], $labels);
            if (isset($labelName)) {
              $labelNames .=  $labelName . ', ';
            }
          }
          if ($accountLabelsCount > 0) {
            echo 'Labels: ' . substr($labelNames, 0, -2) . '<br/>';
          }

          echo 'Industry: '.$accounts[$i]->getIndustry().'<br/>';
          echo 'Nace Code: '.$accounts[$i]->getNaceCode().'<br/>';
          echo 'Size: '.$accounts[$i]->getSizeCategory().'<br/>';
          echo 'Employees: '.$accounts[$i]->getEmployeeCount().'<br/>';
          echo 'Website: '.$accounts[$i]->getWebsite().'<br/>';
          echo 'City: '.$accounts[$i]->getCity().'<br/>';
          echo 'Zip Code: '.$accounts[$i]->getZipCode().'<br/>';
          echo 'Country Code: '.$accounts[$i]->getCountryCode().'<br/>';

          $activityType = $activityController->retrieveActivityTypeLabel($accounts[$i]->getLastActivityType());

          $ladate = $accounts[$i]->getLastActivityDate();
          echo 'Last activity: '.$activityType.' (' . $ladate->format('d F Y H:i:s').')<br/>';

          echo '<h2>Activities </h2>';
          $accountActivities = $accounts[$i]->getActivities();
          for($j = 0; $j < count($accountActivities); $j++){
            echo '<h3>Type: ' . $activityController->retrieveActivityTypeLabel($accountActivities[$j]->getActivityType()) . '</h3>';

            $activityDate = $accountActivities[$j]->getActivityDate();
            echo 'Activity Date: ' . $activityDate->format('d F Y H:i:s') . '<br/>';

            echo 'Activity ID: ' . $accountActivities[$j]->getIdActivity() . '<br/>';
            echo 'Campaign Name: ' . $accountActivities[$j]->getCampaignName() . '<br/>';

            $visitedPages = $accountActivities[$j]->getVisitedPages();
            $visitedPagesCount = count($visitedPages);
            if ($visitedPagesCount > 0) {
              echo '<h4>Visited Pages </h4>';
            }
            for($k = 0; $k < $visitedPagesCount; $k++){
              echo 'URL: ' . $visitedPages[$k]->getUrl() . '<br/>';
              echo 'ID URL: ' . $visitedPages[$k]->getIdUrl() . '<br/>';
              echo 'Duration (in s): ' . $visitedPages[$k]->getDuration() . '<br/>';
            }

            $referer = $accountActivities[$j]->getReferer();
            if (isset ($referer)) {
              echo '<h4>Referer </h4>';
              echo 'Category ID: ' . $referer->getIdCategory() . '<br/>';
              echo 'Name: ' . $referer->getName() . '<br/>';
            }

            $openers = $accountActivities[$j]->getEmailOpeners();
            $openerCount = count($openers);
            if ($openerCount > 0) {
              echo '<h4>Email openers </h4>';
            }
            for($m = 0; $m < $openerCount; $m++){
              echo 'Email: ' . $openers[$m]->getEmailAddress() . '<br/>';
              $openDate = $openers[$m]->getOpenDate();
              echo 'Open Date: ' . $openDate->format('d F Y H:i:s').'<br/>';
            }
          }
          echo '</div>';
        }
    }
?>

</div>
</body>
