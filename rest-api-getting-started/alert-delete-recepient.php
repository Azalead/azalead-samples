<?php
/***********************************************************
    Alert
    Remove alert recipient
************************************************************/

    $idAccount = 'ACCOUNT_ID';
    $idUser = 'USER_ID';
    $token = 'YOUR_TOKEN';

    //delete alert recepient
    $ch = curl_init('https://apiv2.azalead.com/v2/account/'.$idAccount.'/alert-recipient/'.$idUser);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'X-Auth-Token:Bearer '.$token)
      );

    //execute request
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //close connection
    curl_close($ch);

    $decodedData = json_decode($response);
    $token = $decodedData->{'token'};
?>
<html>
  <head>
    <title>Delete alert recepient</title>
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body>
    <div class="main-content">

      <h1>Alert recipient removed</h1>
      <p>
<?php
    if ($httpcode != 200) {
        echo 'Status code: '.$httpcode;
        echo $decodedData->message;
    } else {
        echo  $decodedData->firstName.' ' .$decodedData->lastName.'<br/>';
        echo 'Email: ' .$decodedData->email;
    }      
?>
    </p>
</div>
</body>
</html>