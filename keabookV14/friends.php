<?php
  $sTitle = "Friends";
  $sLinkToCss = 'friends';
  require_once './components/top.php';
?>

<div class="friendsAndPeople">

  <div>
    <h1>Friends</h1>
    <?php
    $sData = file_get_contents('data.txt');
    $jData = json_decode($sData);
    // Id of the user that is logged
    $sLoggedUserId = $_SESSION['jUser']->id;
    foreach( $jData->users->$sLoggedUserId->friends as $sFriendId => $uValue ){
      echo $jData->users->$sFriendId->email;
    }
    ?>
  </div>

  <div id="users">

    <?php
    $sDivUser = '<div class="user" id="{user id}">
                    <img src="https://graphicresourcesinc.com/wp-content/uploads/5849_L.jpg">
                    <span>{user name}</span>
                    <button class="btnSendFriendRequest">{button text}</button>
                  </div>';

    $sData = file_get_contents('data.txt');
    $jData = json_decode($sData);
    $sLoggedUserId = $_SESSION['jUser']->id;
    echo json_encode($_SESSION['jUser']);
    foreach($jData->users as $sUserId => $jUser){
      $sTempDivUser = $sDivUser;
      $sTempDivUser = str_replace('{user id}', $sUserId, $sTempDivUser);
      $sTempDivUser = str_replace('{user name}', $jUser->email, $sTempDivUser);
      $sButtonText = isset($jData->users->$sLoggedUserId->sentFriendRequests->$sUserId) ? 'pending' : 'add friend' ;
      $sTempDivUser = str_replace('{button text}', $sButtonText, $sTempDivUser);
      echo $sTempDivUser;
    }


    ?>

  </div>

</div>





<?php
require_once './components/bottom.php';






