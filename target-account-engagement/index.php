<?php
session_start();

if (!isset($_SESSION["user_token"])) {
  header('Location: views/authenticate.php');
} else {
?>
<html>
  <head>
    <title>Azalead API</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="main-content">
        <a href="views/list_accounts.php">Get target account activities</a>
    </div>
</body>
</html>
<?php
}
?>
