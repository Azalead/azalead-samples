<?php
session_start();
require_once('../helpers/functions.php');
require_once('../models/api_error.php');
require_once('../models/api_result.php');

/***********************************************************
    Authenticate
    Get your user token
************************************************************/
if (isset($_POST['username']) && isset($_POST['password']) &&
    $_POST['username'] != null && $_POST['password'] != null) {
    $username   = $_POST["username"];
    $password   = $_POST["password"];
    $apiResults = authenticate($username, $password);
    $apiError = $apiResults->getApiError();

    if ($apiError == null) {
      $results = $apiResults->getResults();
      $_SESSION["user_token"] = $results->token;
      header('Location: ../index.php');
    }
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
    if (isset($apiError) && ($apiError != null)) {
        echo 'Status code: ' . $apiError->getStatus() . '<br/>';
        echo 'Title: ' . $apiError->getTitle() . '<br/>';
        echo $apiError->getDetail() . '<br/>';
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
