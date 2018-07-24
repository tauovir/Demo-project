<!--============ERROR AND SUCCESS END=============-->
    
  
    <!-- ============== Login Section End ============== -->
    
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Forgot Pasword</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700');
    * {
        box-sizing: border-box;
    }
    
     ::-webkit-input-placeholder {
        color: #ffffff;
    }
    
     ::-moz-placeholder {
        color: #ffffff;
    }
    
     :-ms-input-placeholder {
        color: #ffffff;
    }
    
     :-moz-placeholder {
        color: #ffffff;
    }
    
    a,
    input,
    button {
        transition: all 0.3s ease-out;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
    }
    
    html,
    body {
        height: 100%;
    }
    
    body {
        padding: 0;
        margin: 0;
        font-family: 'Source Sans Pro', sans-serif;
    }
    
    .wrapper {
        min-height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgb(252, 35, 47);
        background: -moz-linear-gradient(-45deg, rgba(252, 35, 47, 1) 0%, rgba(252, 47, 86, 1) 100%);
        background: -webkit-linear-gradient(-45deg, rgba(252, 35, 47, 1) 0%, rgba(252, 47, 86, 1) 100%);
        background: linear-gradient(135deg, rgba(252, 35, 47, 1) 0%, rgba(252, 47, 86, 1) 100%);
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#fc232f', endColorstr='#fc2f56', GradientType=1);
    }
    
    .form-wrap {
        width: 645px;
        margin: 0 auto;
        max-width: 98%;
        padding: 10px 25px 25px;
    }
    
    .heading {
        color: #fff;
        font-size: 24px;
        margin: 10px 0 50px;
        font-weight: 500;
    }
    
    .back {
        display: inline-block;
        color: #fff;
        padding: 8px 0 8px 15px;
        text-decoration: none;
        position: relative;
        font-size: 16px;
        opacity: 0.8;
    }
    
    .back:before {
        content: '';
        position: absolute;
        left: 0;
        top: 11px;
        width: 0;
        height: 0;
        border: solid #ffffff;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 6px;
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
        -moz-transform: rotate(135deg);
        -ms-transform: rotate(135deg);
    }
    
    .back:hover {
        opacity: 1;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .input-wrap {
        position: relative;
    }
    
    .inputClass {
        font-size: 16px;
        padding: 15px 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.45);
        border: solid 2px transparent;
        color: #fff;
        width: 100%;
        line-height: 1.4;
        letter-spacing: 0.2px;
        font-family: 'Source Sans Pro', sans-serif;
    }
    
    .inputClass:focus {
        border: solid 2px #b91717;
        outline: none;
    }
    
    .custom-btn {
        background: #fff;
        color: #fb4454;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        font-family: 'Source Sans Pro', sans-serif;
        text-align: center;
        width: 100%;
        padding: 20px 20px;
        margin-top: 40px;
        border: none;
        cursor: pointer;
    }
    
    .custom-btn:hover,
    .custom-btn:focus {
        background: #b91717;
        outline: none;
        color: #fff;
    }
    
    .error-msg {
        color: #ffffff;
    }
</style>

<body>
    <div class="wrapper">
      
        <div class="form-wrap">
           
            <h1 class="heading">Forgot Password</h1>
                    
                <form method="POST" method="POST" action="{{url('/')}}/reset-password" class="inputForm" id="resetPasswordId">
                 <input type="hidden" name="token" value="{{$token}}">
                   {{ csrf_field() }}
                    <div class="form-group">
                    <div class="input-wrap">
                        <input type="text" readonly="true" class="inputClass" placeholder="E-mail address" value="{{$email}}">
                     
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrap">
                          <input id="temp_password" type="text" class="inputClass" maxlength="6" placeholder="temporary password"  name="temp_password"   value="{{ old('temp_password') }}">
                          <!--***************Error Message****************-->
                        @if(Session::has('webError'))  
                        <span class="error-msg"> {{Session::get('webError')}}</span>
                        {{Session::forget('webError')}}
                         @endif
                          <!--***************Error Message End****************-->
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-wrap">
                         <input id="password" type="password" class="inputClass" placeholder="new password"  maxlength="30" name="password" required>

                    </div>
                </div>
                <div class="buttonWrap text-center">
                    <button type="submit" class="custom-btn">Create New Password</button>
                </div>
            </form>
            <!-- form end-->
        </div>
    </div>
    <!-- Wrapper closed-->
</body>
<script src="{{url('/')}}/public/web/js/jquery-3.2.0.min.js"></script>
<script src="{{url('/')}}/public/web/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/public/web/js/jquery.validate.min.js"></script>

<script src="{{url('/')}}/public/web/js/reset-password.js"></script>


</html>