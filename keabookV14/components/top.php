<?php
session_start();
if( !isset($_SESSION['jUser']) ){
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $sTitle.' '.$_SESSION['jUser']->id; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/<?= $sLinkToCss; ?>.css" />
</head>
<body>

  <div class="container">
    
    <div id="navbar">
      <div>Hi <?= $_SESSION['jUser']->email; ?></div>
      <div>Profile</div>
      <div>
        <a href="friends.php">Friends</a>
      </div>
      <div>Market Place</div>
      <div>My Products</div>
      <div>
        <a href="logout.php" class="text-danger">Logout</a>
      </div>
    </div>