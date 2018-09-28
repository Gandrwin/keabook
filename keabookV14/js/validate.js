
/**************************************************/
/**************************************************/
/**************************************************/ 
// Disable all forms submission
$(document).on( 'submit' , 'form' , function(e){
  // e.preventDefault()
})


/**************************************************/
/**************************************************/
/**************************************************/ 
function validateForm( oForm ){
  var bErrors = false
  $( 'input , textarea' , oForm ).each( function(){
    if( $( this ).attr( 'data-validate' ) == 'yes' ){
      // remove error style
      $( this ).removeClass( 'err' )
      var sType = $( this ).attr( 'data-type' )
      switch (sType) {
        case "text":
          var sText = $(this).val();
          sText = sText.trim();
          var iMinLength = parseInt($(this).attr("data-min"));
          var iMaxLength = parseInt($(this).attr("data-max"));
          var bValid = isText(sText, iMinLength, iMaxLength);
          if (!bValid) {
            $(this).addClass("err");
            bErrors = true;
          }
        break;

        case "number":
          var iNumber = parseInt($(this).val())
          var iMinNumber = parseInt($(this).attr("data-min"))         
          var iMaxNumber = parseInt($(this).attr("data-max"))          
          var bValid = isNumber(iNumber, iMinNumber, iMaxNumber)
          if (!bValid){
            $(this).addClass("err");
            bErrors = true;
          }
        break;

        case "email":
          var sEmail = $(this).val()
          sEmail = sEmail.trim()
          var bValid = isEmail(sEmail)
          if (!bValid) {
            $(this).addClass("err")
            bErrors = true;
          }
        break;
      }
    }
    
    // validate matching elements
    if ($(this).attr("data-match")){
      var sData = $(this).val()
      sData = sData.trim()
      var sIdElementToMatch = $(this).attr("data-match")
      var sValueToMatch = $("#" + sIdElementToMatch).val()
      sValueToMatch = sValueToMatch.trim()
      if( $(this).val() != sValueToMatch ){
        $(this).addClass('err')
        $("#" + sIdElementToMatch).addClass('err');
        bErrors = true;
      }
    }
    

  })
  return bErrors ? false : true
}


/**************************************************/
/**************************************************/
/**************************************************/
function isText(sToValidate, iMinLength, iMaxLength){
  if (!Number.isInteger(iMinLength) || !Number.isInteger(iMaxLength))
    return false;
  if (sToValidate.length < iMinLength || sToValidate.length > iMaxLength)
    return false;
  return true;
};

/**************************************************/
/**************************************************/
/**************************************************/
function isEmail(sEmail){
  var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(sEmail.toLowerCase());
};

/**************************************************/
/**************************************************/
/**************************************************/
function isNumber(iNumber, iMin, iMax){
  if (isNaN(iNumber) || iNumber < iMin || iNumber > iMax) return false;
  return true;
};

/**************************************************/
/**************************************************/
/**************************************************/
function isEqual(uDataOne, uDataTwo){
  if (uDataOne !== uDataTwo) return false;
  return true;
};

/**************************************************/
/**************************************************/
/**************************************************/





