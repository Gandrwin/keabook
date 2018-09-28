<?php
  // check that the user has passed the expected values 
  if( filter_var($_POST['txtUserEmail'], FILTER_VALIDATE_EMAIL) &&
      !empty($_POST['txtUserConfirmPassword']) &&
      strlen($_POST['txtUserPassword']) >= 6 &&
      strlen($_POST['txtUserPassword']) <= 20 &&
      ( $_POST['txtUserPassword'] == $_POST['txtUserConfirmPassword'] )
  ){
    // open the file
    $sData = file_get_contents('data.txt');
    // convert to object
    $jData = json_decode($sData);
    // create a unique id for the user
    $sUniqueId = uniqid('U');
    // create a json user
    $jUser = json_decode('{}');
    $jUser->email = $_POST['txtUserEmail'];
    $jUser->password = $_POST['txtUserPassword'];
    $jUser->friends = json_decode('{}');
    $jUser->sentFriendRequests = json_decode('{}');
    $jUser->receivedFriendRequests = json_decode('{}');
    $jUser->products = json_decode('{}');
    
    // add user to object
    $jData->users->$sUniqueId = $jUser;
    // back to text
    $sData = json_encode($jData);
    // save to file
    file_put_contents('data.txt', $sData);
    // save user in the session without the user's password
    session_start();
    unset($jUser->password);
    $_SESSION['jUser'] = $jUser;
    // redirect to admin
    header('Location: admin.php');
  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>keabook : : signup</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/signup.css">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
<body>

  <div class="container">
    <div id="boxSignup">
      <form action="signup.php" method="post">
        <input name="txtUserEmail" type="text" placeholder="email" value="a@a.com">
        <input name="txtUserPassword" class="marginTop10" type="password" placeholder="password" value="123456">
        <input name="txtUserConfirmPassword" class="marginTop10" type="password" placeholder="confirm password" value="123456">
        <button class="marginTop10">signup</button>
      </form>
    </div>
  </div>

  
</body>
</html>