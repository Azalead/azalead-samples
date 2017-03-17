<?php
/***********************************************************
    Authenticate
    Get your user token
************************************************************/

if (isset($_POST['username']) && isset($_POST['password']) &&
      $_POST['username'] != null && $_POST['password'] != null) {
    $username   = $_POST["username"];
    $password   = $_POST["password"];
    $data = array("username" => $username, "password" => $password);
    $data_string = json_encode($data);

    //authenticate
    $ch = curl_init('https://apiv2.azalead.com/v2/authenticate');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );

    //execute request
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //close connection
    curl_close($ch);

    $decodedData = json_decode($response);
    $token = $decodedData->{'token'};
}
?>
<html>
  <head>
    <title>Authenticate</title>
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body>
    <div class="main-content">
   <form class="form-login" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
     <div class="form-white-background">
        <div class="form-title-row">
           <h1>Get your API token</h1>
        </div>
<?php
    if (isset($token) && $token != null) {
        echo '<div class="form-title-row">'.$token.'</div>';
    } else {
        echo 'Status code: '.$httpcode;
        echo $decodedData->message;
    }     
?>
        <div class="form-row">
           <label>
           <span>Login</span>
           <input type="text" name="username">
           </label>
        </div>
        <div class="form-row">
           <label>
           <span>Password</span>
           <input type="password" name="password">
           </label>
        </div>
        <div class="form-row">
           <button type="submit" name="submit">Authenticate</button>
        </div>
     </div>
   </form>
</div>
</body>
</html>