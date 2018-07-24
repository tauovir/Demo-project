$(function() {
    var baseUrl = $("input[name=baseUrl]").val();
$("input[name=signupUserName]").prop( "disabled", true );
$(".changeName").hide();

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
     * Remove Error layer
     */
    $(document).on('click', '.registerModal .removeMsg', function() {
        $(this).parent().removeClass('open');
    });

    
   
    
//*****************Signup validation******************** */
/**Clear User name */
/**
 * Clear User name when click on chnage buttton on signup form
 */
$(document).on('click', '.changeName', function() {
    $("input[name=signupUserName]").val(''); 
  });

/**
 * Check user name and email is alreayd exist in our Database or not
 * @param {*} jsonData 
 */
function callAjax(jsonData) {
$.ajax({
    type: "post",
    url: baseUrl + "/get-username",
    data: JSON.stringify(jsonData),
    headers: {
        'Content-Type': "application/json; charset=utf-8",
        cache: false,
        dataType: "json",
        'X-CSRF-Token': $('input[name="_token"]').val(),
    },
}).done(function (response) {
  if(response.code == 200) {
    $("input[name=signupUserName]").val(response.data.userName); 
    $("input[name=signupUserName]").prop( "disabled", false );
    $(".changeName").show();
    
} else {
        $("input[name=signupEmail]").val('');
        $("#signupEmailError" ).text(response.message);
        $("#signupEmailError").parent().addClass('open');
  } 
});

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
$("input[name=signupEmail]").keyup(function(){
    var email = $("input[name=signupEmail]").val();
   if(CommonValidation.isValidEmail(email)) {
       var data = {'email':email};
       callAjax(data);
   }
});

/*
 * Description: Validate signup form before submiting it
 * @Date : 24-02-2018
 */
 $('#signupId').validate({
        errorElement: 'span',
        rules: {
            signupEmail: {
                required: true,
                email: true,
                 remote: {
                    url:  baseUrl + "/check-userOrEmail-exist",
                    data : {'type':1},
                    type: "get"
                 }
            },
              signupPassword: {
                required: true,
                minlength : 6
            },
            signupUserName: {
                required: true,
                minlength : 3,
                remote: {
                    url:  baseUrl + "/check-userOrEmail-exist",
                    data : {'type':2},
                    type: "get"
                 }
            },
            
        },
        messages: {
            signupEmail: {
                required: lang('PleaseEnterYourEamilAddess'),
                email: lang('PleaseEnterValidEamilAddess'),
                remote: lang('emailAlreadyExist'),
            },
            signupPassword: {
                required: lang('signupEnterPassword'),
                minlength: lang('enterValidPassword'),
            },
             signupUserName: {
                required: lang('signupEnterUserName'),
                minlength: lang('signupUserMustBe'),
               remote: lang('userAlreadyExist'),
            }
        },
        errorPlacement: function(error, element) {
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

/*
 * Description: Validate login form before submiting it
 * @Date : 24-02-2018
 */
 $('#loginFormId').validate({
        errorElement: 'span',
        onkeyup: false,
        rules: {
            email: {
                required: true,
                email: true,
                 remote: {
                    url:  baseUrl + "/check-userOrEmail-exist",
                    data : {'type':3},
                    type: "get"
                 }
            },
              password: {
                required: true,
                minlength : 6
            },   
        },
        messages: {
            email: {
                required: lang('PleaseEnterYourEamilAddess'),
                email: lang('PleaseEnterValidEamilAddess'),
                remote: lang('emailNotExist'),
            },
            password: {
                required: lang('signupEnterPassword'),
                minlength: lang('enterValidPassword'),
            },
        },
        errorPlacement: function(error, element) {
           if(element.attr("name") == "email") {
           $("#loginEmailError" ).text(error.text());
        $("#loginEmailError").parent().addClass('open');
    } else if(element.attr("name") == "password") {
           $("#loginPasswordError" ).text(error.text());
        $("#loginPasswordError").parent().addClass('open');
    }
    
        }
    });



//=================Sigin==============/
});