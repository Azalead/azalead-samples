<?php
/***********************************************************
    Alert
    Add alert recipient
************************************************************/

  $idAccount = 'ACCOUNT_ID';
  $idUser = 'USER_ID';
  $token = 'YOUR_TOKEN';

  $data = array("id" => $idUser);
  $data_string = json_encode($data);

  //add alert recipient
  $ch = curl_init('https://apiv2.azalead.com/v2/account/'.$idAccount.'/alert-recipient/');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string),
      'X-Auth-Token:Bearer '.$token
      )
  );

  //execute request
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  //close connection
  curl_close($ch);

  // decode json response
  $decodedData = json_decode($response);
?>
<html>
  <head>
    <title>Add alert recipient</title>
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body>
    <div class="main-content">
      <h1>Alert recipient added</h1>
      <p>
<?php
    if ($httpcode != 200) {
        echo 'Status code: '.$httpcode;
        echo $decodedData->message;
    }  else {      
        echo  $decodedData->firstName.' ' .$decodedData->lastName.'<br/>';
        echo 'Email: ' .$decodedData->email;
    }    
?>
      </p>
</div>
</body>
</html>