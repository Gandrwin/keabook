</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).on('click', '.btnSendFriendRequest', function(){
    var sPotentialFriendId = $(this).parent().attr('id')
    $.ajax({
      url: "apis/api-send-friend-request.php",
      data:{potentialFriendId: sPotentialFriendId}
    }).done(function(sData){
      console.log(sData)
    })    
  })

  // -------------------------------------------
  // Check if someone would like to be my friend
  var bAlerted = false
  setInterval( function(){
    $.ajax({
      url:"apis/api-check-for-friends.php"
    }).done(function(sData){
      console.log(sData)
      if(sData == 'yes' && bAlerted == false ){
        console.log('yes')
        swal({
          title: "Someone send you a friend request",
          text: "You can eighter reject or accept. Once rejected, you will not be able to receive requests from this person",
          icon: "info",
          buttons:['Accept','Reject'],
          dangerMode: true,
            })
        .then((willDelete) => {
          if (willDelete) {
            swal("You have deleted the friend request. You can no longer accept requests from this person.", {
              icon: "success",
            });
            } else {
              swal("You have accepted the friend request");
            }
});
        var oSound = new Audio('sound.mp3');
        oSound.play();  
        bAlerted = true;      
      }
    })

  }, 100000 ) //change to 60k for 1min.

 

</script>


  
</body>
</html>