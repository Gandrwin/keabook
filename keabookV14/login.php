<?php
  // check that the user has passed the expected values 
  if( !empty($_POST['txtUserEmail']) && 
      !empty($_POST['txtUserPassword']) && 
      filter_var($_POST['txtUserEmail'], FILTER_VALIDATE_EMAIL) &&
      strlen($_POST['txtUserPassword']) >= 6 &&
      strlen($_POST['txtUserPassword']) <= 20
  ){
    // open the file
    $sData = file_get_contents('data.txt');
    // convert to object
    $jData = json_decode($sData);
    foreach($jData->users as $sId => $jUser){
      if( $jUser->email == $_POST['txtUserEmail'] &&
          $jUser->password == $_POST['txtUserPassword']){
          // save user in the session without the user's password
          session_start();
          unset($jUser->password);
          // id:"U565hthh"
          $jUser->id = $sId;
          $_SESSION['jUser'] = $jUser;
          // redirect to admin
          header('Location: admin.php');        
      }
    }


  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>keabook : : login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="css/login.css">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
<body>

  <div class="container">
    <div id="boxLogin">
      <form action="login.php" method="post" onsubmit="return validateForm(this)">

        <input name="txtUserEmail" type="text" placeholder="email" value=""
        data-validate="yes" data-type="email">

        <input name="txtUserPassword" class="marginTop10" type="password" 
        placeholder="password" value=""  
        data-validate="yes" data-type="text" data-min="6" data-max="20">
        
        
        <button class="marginTop10">login</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/validate.js"></script>


</body>
</html>