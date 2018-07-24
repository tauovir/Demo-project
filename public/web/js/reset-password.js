
$(document).ready(function () {
  
    $(".numbersOnly").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
   
  

$('#resetPasswordId').validate({

    errorClass: 'error-msg',
    ignore: ":hidden:not(.selectpicker)",
    onkeyup: false,
    rules: {
        temp_password: {
            required: true,
            minlength: 6,
            maxlength: 6
        },
       
        password: {
            required: true,
             minlength: 8,
             maxlength: 50,
        },
       
    },
    messages: {
        temp_password: {
            required: 'Please enter temporary password',
            minlength: 'Please enter minimum 6 characters',
            maxlength: 'Please enter miximum 6 characters',
        },
        password: {
            required: 'password required',
           minlength: 'Minimum 8 charecter password required',
            maxlength: 'No more than 50 charecter password',
        },
        
    },
    errorPlacement: function (error, element) {
        var placement = $(element).data('error-messg');
        if (placement) {
            $(placement).append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        form.submit();
    }
});         
  
            
            
});





   
    
    
    
    