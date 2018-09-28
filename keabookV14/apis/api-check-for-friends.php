<?php
session_start();
$sLoggedUserId = $_SESSION['jUser']->id;

$sData = file_get_contents('../data.txt');
$jData = json_decode($sData);
if( $jData->users->$sLoggedUserId->receivedFriendRequests == json_decode('{}')){
  echo 'no';
}else{
  echo 'yes';
}


