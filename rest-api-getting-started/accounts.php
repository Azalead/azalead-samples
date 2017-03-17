<?php
/***********************************************************
    Accounts
    List accounts
************************************************************/
  $token = 'YOUR_TOKEN';

  $ch = curl_init('https://apiv2.azalead.com/v2/account');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'X-Auth-Token:Bearer '.$token)
  );

  //execute request
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  //close connection
  curl_close($ch);

  $accounts = json_decode($response);

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
    if ($httpcode != 200) {
        echo 'Status code: '.$httpcode;
        echo $decodedData->message;
    } else {
        date_default_timezone_set('UTC');
        echo '<table>';
        echo '<tr><th>Account</th><th>Industry</th><th>Country</th><th>Date</th><th>Last Action</th><th>Target Account</th></tr>';
        for($i = 0; $i < count($accounts); $i++){
          echo '<tr>';
          echo '<td>'.$accounts[$i]->name.'</td>';
          echo '<td>'.$accounts[$i]->industry.'</td>';
          echo '<td>'.$accounts[$i]->country.'</td>';

          $ladate = new DateTime();
          $ladate->setTimestamp(($accounts[$i]->lastActivityDate)/1000);
          echo '<td>'.$ladate->format('d F Y H:i:s').'</td>';

          $activityType;
          switch ($accounts[$i]->lastActivityType) {
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
          echo '<td>'.$activityType.'</td>';
          echo '<td>'.$accounts[$i]->target.'</td>';
          echo '</tr>';
        }
        echo '</table>';
    }      
?>

</div>
</body>
</html>