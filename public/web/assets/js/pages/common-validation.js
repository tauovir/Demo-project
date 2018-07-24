var CommonValidation = {
emailValid : function(email, email_msg) {
    var emailFlag = true;
    $("#" + email_msg).text("");
    var vemail = email;
    
     if (email == '' || email == null) {
        $("#" + email_msg).text(lang('PleaseEnterYourEamilAddess'));
        $("#" + email_msg).parent().addClass('open');
        
        emailFlag = false;
        return emailFlag;
    }
    
    
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(vemail)) {
        emailFlag = true;
        return emailFlag;
    } else {
        $("#" + email_msg).text(lang('PleaseEnterValidEamilAddess'));
        $("#" + email_msg).parent().addClass('open');
        emailFlag = false;
        return emailFlag;
    }
    return emailFlag;
},
isValidEmail : function(email) {
    var emailFlag = true;
     if (email == '' || email == null) {
       return  emailFlag = false;
    }
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email)) {
        return emailFlag = true;
    } else {
       return  emailFlag = false;
    }
    return emailFlag;
},
checkPassword : function (password,errorMessage) {
    var emailFlag = true;
    if (password == '' || password == undefined) {
       $("#"+errorMessage ).text(lang('signupEnterPassword'));
       $("#"+errorMessage).parent().addClass('open');
       emailFlag = false;
       return emailFlag;
   }
   if(password.length < 6 ) {
       $("#"+errorMessage ).text(lang('enterValidPassword'));
       $("#"+errorMessage).parent().addClass('open');
       emailFlag = false;
       return emailFlag;
   }
   return emailFlag;
    },

    userName : function (password,errorMessage) {
        var emailFlag = true;
        if (password == '' || password == undefined) {
           $("#"+errorMessage ).text(lang('signupEnterUserName'));
           $("#"+errorMessage).parent().addClass('open');
           emailFlag = false;
           return emailFlag;
       }
       if(password.length < 3 ) {
           $("#"+errorMessage ).text(lang('signupUserMustBe'));
           $("#"+errorMessage).parent().addClass('open');
           emailFlag = false;
           return emailFlag;
       }
      
       return emailFlag;
        },


pincodeValid : function(param_name, name_msg) {
    pincodeFlag = true;
   var pincode = param_name
   if (pincode == undefined || pincode == null) {
        $("#" + name_msg).text(lang('please_enter_pinvcode'));
        $("#" + name_msg).addClass('error-messg');
        pincodeFlag = false;
       
    }
     if (pincode.length < 5) {
        $("#" + name_msg).text(lang('please_enter_valid_pinvcode'));
        $("#" + name_msg).addClass('error-messg');
        pincodeFlag = false;
       
    }
   return pincodeFlag;  
},

passwordValid : function(param_name, name_msg) {
    flag = true;
   var pincode = param_name
   if (pincode == undefined || pincode == null) {
        $("#" + name_msg).text(lang('please_enter_password'));
        $("#" + name_msg).addClass('error-messg');
        flag = false;
       
    }
     if (pincode.length < 6) {
        $("#" + name_msg).text(lang('password_should_be'));
        $("#" + name_msg).addClass('error-messg');
        flag = false;
       
    }
   return flag;  
},

leapYear : function(year) {
     if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) {
        return true;
    } else {
         return false;
    }


},
dobValid : function(day1,month1,year1) {
  var day = parseInt(day1);
  var month = parseInt(month1);
  var year = parseInt(year1);
    if(this.leapYear(year)) {
     if(month == 2 && day > 29) {
         return  false;
     } else {
         return true
     }  
    } else if(month == 2 && day > 28) {
         return  false;
     } else {
         return true;
     }  
} 

}
