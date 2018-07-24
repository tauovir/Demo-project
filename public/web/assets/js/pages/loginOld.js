$(function() {

   /**
    * When Login time error occure so open login popup
    * 
    **/ 
   if($('#loginError').length > 0) {
    $('#loginModal').modal('show'); 
    }
/**
    * When Signup time error occure so open signup popup
    * 
    **/ 
if($('#signupError').length > 0) {
 $('#signupModal').modal('show'); 
}

/**
 * Submit Login Form
 */
    $(document).on('click', '.signinBtn', function() {
       // $('.errorMsg').addClass('open');
 if( checkEmail() && checkPassword()) {
        $('#loginFormId').submit();
        }
    });

    /**
     * Remove Error layer
     */
    $(document).on('click', '.registerModal .removeMsg', function() {
        $(this).parent().removeClass('open');
    });

    /**
     * @Description: Validate email while customer going to login
     * Date : 24-05-2018
     */
function checkEmail() {
var email = $("input[name=email]").val();
emailFlag = CommonValidation.emailValid(email,'loginEmailError');
if(emailFlag ==false) {
    $("input[name=email]").val('');
   }
return emailFlag;
}
    /**
     * @Description: Validate password while customer going to login or signup
     * Date : 24-05-2018
     */
function checkPassword() {
    var password = $("input[name=password]").val();
    var emailFlag = CommonValidation.checkPassword(password,'loginPasswordError');
   if(emailFlag ==false) {
    $("input[name=password]").val('');
   }
   return emailFlag;
    }
    
//*****************Signup validation******************** */
/**Clear User name */
var sEmailFlag = true,sPassflag=true,sUserFlag = true;
/**
 * Clear User name when click on chnage buttton on signup form
 */
$(document).on('click', '.changeName', function() {
    $("input[name=signupUserName]").val(''); 
  });

/**
 * Submit signup form
 */
$(document).on('click', '.signupModal33 .customBtn', function() {
   // $('.errorMsg').addClass('open');
   $("input[name=signupEmail]").blur();
     $("input[name=signupPassword]").blur();
   $("input[name=signupUserName]").blur();
  
    if(sEmailFlag && sPassflag && sUserFlag) {
        $('#signupId').submit(); // Submit signup form
    }
   
 });

 /**
  * Description : On blure function check email
  *
 
$("input[name=signupEmail]").blur(function(){
    var email = $("input[name=signupEmail]").val();
    sEmailFlag = CommonValidation.emailValid(email,'signupEmailError');
    if(sEmailFlag ==false) {
    $("input[name=signupEmail]").val('');
    return sEmailFlag;
     }
    var jsonData = {'email':email,'type':1};
    sEmailFlag = callAjax(jsonData);
    return sEmailFlag;
})
*/
/**
  * Description : On blure function check email
  *
 
 $("input[name=signupPassword]").blur(function(){
    var password = $("input[name=signupPassword]").val();
   // var flag = checkPassword1(password,'signupPasswordError');
   sPassflag = CommonValidation.checkPassword(password,'signupPasswordError');
    if(sPassflag == false) {
        $("input[name=signupPassword]").val('');
    }
    return sPassflag;
})

*/


/**
  * Description : On blure function check User Name
  *
  $("input[name=signupUserName]").blur(function(){
    var userName = $("input[name=signupUserName]").val();
    sUserFlag = CommonValidation.checkPassword(userName,'signupUserError');
    if(sUserFlag == false) {
        $("input[name=signupUserName]").val('');
    }
    var jsonData = {'email':userName,'type':2};
    sUserFlag = callAjax(jsonData);
    return sUserFlag;
})
*/
/**
 * Check user name and email is alreayd exist in our Database or not
 * @param {*} jsonData 
 */
function callAjax(jsonData) {
  var flag =  true;
var baseUrl = $("input[name=baseUrl]").val();
$.ajax({
    type: "post",
    url: baseUrl + "/user-check",
    data: JSON.stringify(jsonData),
    headers: {
        'Content-Type': "application/json; charset=utf-8",
        cache: false,
        dataType: "json",
        'X-CSRF-Token': $('input[name="_token"]').val(),
    },
}).done(function (response) {
  if(response.code == 200) {
    if(jsonData.type == 1) {
    $("input[name=signupUserName]").val(response.data.userName); 
    } 
  } else {
    flag == false;
    if(jsonData.type == 1) {
        $("input[name=signupEmail]").val('');
        $("#signupEmailError" ).text(response.message);
        $("#signupEmailError").parent().addClass('open');
    } else if(jsonData.type == 2) {
        $("input[name=signupUserName]").val('');
        $("#signupUserError" ).text(response.message);
        $("#signupUserError").parent().addClass('open');
    }
  } 
});
return flag;

}

/**
 * Description: Forgot password
 * 
 */

$(document).on('click', '.resetBtn', function() {
    var email = $("input[name=resetEmail]").val();
    if(email == '' || email == undefined) {
        $("#resetError" ).text(lang('userOrPass'));
        $("#resetError").parent().addClass('open');
        return;
    }
    if(email.length < 4) {
        $("#resetError" ).text(lang('userOrPassValid'));
        $("#resetError").parent().addClass('open');
        return;
    }
    sendPasswordLink(email);
});
/**
 * Send reset password link to customer
 * @param {emails} email 
 */
function sendPasswordLink(email) 
{
$('.resetBtn').prop("disabled", true).css({'cursor':'not-allowed'});
    var baseUrl = $("input[name=baseUrl]").val();
   var jsonData = {'emial':email};
   console.log(jsonData);
    $.ajax({
        type: "get",
        url: baseUrl + "/reset-link?email="+email,
        headers: {
            'Content-Type': "application/json; charset=utf-8",
            cache: false,
            dataType: "json",
            'X-CSRF-Token': $('input[name="_token"]').val(),
        },
    }).done(function (response) {
     $('.resetBtn').prop("disabled", false).css({'cursor':'pointer'});
      if(response.code == 200) {
        $('#forgotModal').modal('hide'); 
        $('#forgotSuccessModal').modal('show'); 
      } else {
        $("#resetError" ).text(response.message);
        $("#resetError").parent().addClass('open');
      }
    });
}
/**********Hide Reset password Success pop up *************/
$(document).on('click', '.customBtn', function() {
    $('#forgotSuccessModal').modal('hide');  
});
//========Jquery=========
        $.validator.addMethod("checEmail", function(value) {
		return value == "buga";
	}, 'Please enter "buga"!');
        
 $('#signupId').validate({
        errorElement: 'span',
        rules: {
            signupEmail: {
                required: true,
                email: true,
                 checEmail : true
            },
              signupPassword: {
                required: true,
                minlength : 6
            },
            signupUserName: {
                required: true,
                minlength : 3
            },
            
        },
        messages: {
            signupEmail: {
                required: lang('PleaseEnterYourEamilAddess'),
                email: lang('PleaseEnterValidEamilAddess'),
            },
            signupPassword: {
                required: lang('signupEnterPassword'),
                minlength: lang('enterValidPassword'),
            },
             signupUserName: {
                required: lang('signupEnterUserName'),
                minlength: lang('signupUserMustBe'),
            }
        },
        errorPlacement: function(error, element) {
            console.log(element.attr("name"));
           if(element.attr("name") == "signupEmail") {
           $("#signupEmailError" ).text(error.text());
        $("#signupEmailError").parent().addClass('open');
    } else if(element.attr("name") == "signupPassword") {
           $("#signupPasswordError" ).text(error.text());
        $("#signupPasswordError").parent().addClass('open');
    }else if(element.attr("name") == "signupUserName") {
           $("#signupUserError" ).text(error.text());
        $("#signupUserError").parent().addClass('open');
    }
    
        }
    });

//==================

});