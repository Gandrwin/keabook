<?php
session_start();
// Who sends the request?
$sUserIdSendingRequest = $_SESSION['jUser']->id;
$sPotentialFriendId = $_GET['potentialFriendId'];
// open the file
$sData = file_get_contents('../data.txt');
// convert to object
$jData = json_decode($sData);
// save the potential friend id in the user that is logged in object
$jData->users->$sUserIdSendingRequest->sentFriendRequests->$sPotentialFriendId = "";
// save the received friend request
$jData->users->$sPotentialFriendId->receivedFriendRequests->$sUserIdSendingRequest = "";
// $_SESSION['jUser']->sentFriendRequests->$sPotentialFriendId = "";
// back to text
$sData = json_encode($jData);
// save to file
file_put_contents('../data.txt', $sData);
echo "ok";