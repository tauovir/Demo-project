
<!-- modals -->
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog registerModal">
        <!-- Modal content-->
        <div class="modal-content">
            <h1 class="modalHeading">Log in</h1>
            <div class="modal-body">
                <div class="registerWrapper clearfix">
                    <div class="bannerImage">
                        <div class="logoIcon"><img src="{{url('/')}}/public/web/assets/images/logo-icon.png" alt=""></div>
                        <div class="logoText"><img src="{{url('/')}}/public/web/assets/images/logo-text.png" alt=""></div>
                    </div>
                    <!--<form class="formWrapper"> -->
                          {!! Form::open(['url' => 'signin','class'=>'formWrapper','id'=>'loginFormId']) !!}
                        <!-- social login  -->
                        
                        <div class="form-group">
                            <a href="{{ url('/auth/google') }}" target="_blank" class="socialLogin withGoogle" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/google.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Google</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('yahoo-login') }}" class="socialLogin withYahoo" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/yahoo.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Yahoo</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/auth/facebook') }}" target="_blank" class="socialLogin withFacebook" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/facebook.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Facebook</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/auth/twitter') }}"  target="_blank" class="socialLogin withTwitter" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/twitter.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Twitter</span>
                            </a>
                        </div>
                        <!-- social login end -->
                        <div class="devider">or</div>
                          <!--***************Error Message****************-->

                          @if(Session::has('webError'))  
                        <span class="devider" id="loginError"> {{Session::get('webError')}}</span>
                        {{Session::forget('webError')}}
                         @endif
                          @if(Session::has('passwordIncorrect'))  
                        <span class="devider" id="loginError"></span>
                        
                         @endif
                          <!--***************Error Message End****************-->
                        <!-- login form -->
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="text" class="inputClass" name="email" maxlength="30" placeholder="E-mail address" value="{{ old('email') }}">
                                <span class="errorMsg errorMsg @if ($errors->has('email')) {{"open"}}  @endif" > <span id="loginEmailError">
                                     @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                    @endif
                               </span><span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="password" class="inputClass" maxlength="30" name="password" placeholder="Password">
                                <span class="errorMsg @if ($errors->has('password')) {{"open"}}  @endif @if(Session::has('passwordIncorrect')) {{"open"}} @endif"> <span id="loginPasswordError">
                                    @if ($errors->has('password'))
                                    {{ $errors->first('password') }}
                                    @endif
                                  <!---If password not matched then show this message--->
                                    @if(Session::has('passwordIncorrect'))  
                        {{Session::get('passwordIncorrect')}}
                        {{Session::forget('passwordIncorrect')}}
                         @endif
                                  <!---If password not matched then show this message End--->
                                  
                                </span> <span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
                            
                            </div>
                        </div>
                        <div class="buttonWrap">
                            <button type="submit"  class="customBtn signinBtn" data-ripple> <span> Log in</span></button>
                        </div>
                        <!-- login form end -->
                        <div class="text-center">
                        <a href="javascript:void(0)" class="forgotLink textHover" data-dismiss="modal" data-target="#forgotModal" data-toggle="modal">Forgot password?</a>

                        </div>
                  <!--  </form> -->
                   {!! Form::close() !!}
                </div>
                <!-- register Wrapper end -->
            </div>
        </div>
    </div>
</div>

<!-- forgot modal  -->

<div id="forgotModal" class="modal fade" role="dialog">
    <div class="modal-dialog registerModal forgotModal">
        <!-- Modal content-->
        <div class="modal-content">
            <h1 class="modalHeading">Forgot password</h1>
            <div class="modal-body">
                <div class="registerWrapper clearfix">
                    <div class="bannerImage">
                        <div class="logoIcon"><img src="{{url('/')}}/public/web/assets/images/logo-icon.png" alt=""></div>
                        <div class="logoText"><img src="{{url('/')}}/public/web/assets/images/logo-text.png" alt=""></div>
                    </div>
                    <form class="formWrapper">
                        <!-- login form -->
                        <p class="desc">Provide the e-mail address or username used during registration to recover your password</p>
                        <div class="form-group mb">
                            <div class="inputWrap">
                                <input type="text" class="inputClass" name="resetEmail" maxlength="30" placeholder="E-mail address or username">
                                <span class="errorMsg"><span id="resetError"></span> <span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
                            </div>
                        </div>
                        <p class="desc">We'll send you an e-mail with a password reset link</p>
                        <div class="buttonWrap">
                            <button type="button" class="customBtn resetBtn" > <span> Reset password</span></button>
                        </div>
                    </form>
                </div>
                <!-- register Wrapper end -->
            </div>
        </div> 
    </div>
</div>

<!-- forgot success modal  -->

<div id="forgotSuccessModal" class="modal fade" role="dialog">
    <div class="modal-dialog registerModal forgotSuccessModal">
        <!-- Modal content-->
        <div class="modal-content">
            <h1 class="modalHeading">Forgot password</h1>
            <div class="modal-body">
                <div class="registerWrapper clearfix">
                    <div class="bannerImage">
                        <div class="logoIcon"><img src="{{url('/')}}/public/web/assets/images/logo-icon.png" alt=""></div>
                        <div class="logoText"><img src="{{url('/')}}/public/web/assets/images/logo-text.png" alt=""></div>
                    </div>
                    <form class="formWrapper">
                        <!-- login form -->
                        <p class="desc">A password reset e-mail has been sent to you. Please check your inbox for the password reset link.</p>
                        <div class="buttonWrap">
                            <button type="button" class="customBtn" data-ripple> <span> Done</span></button>
                        </div>
                    </form>
                </div>
                <!-- register Wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- forgot modal  -->

<div id="resetModal" class="modal fade" role="dialog">
    <div class="modal-dialog registerModal resetModal">
        <!-- Modal content-->
        <div class="modal-content">
            <h1 class="modalHeading">Set new password</h1>
            <div class="modal-body">
                <div class="registerWrapper clearfix">
                    <div class="bannerImage">
                        <div class="logoIcon"><img src="{{url('/')}}/public/web/assets/images/logo-icon.png" alt=""></div>
                        <div class="logoText"><img src="{{url('/')}}/public/web/assets/images/logo-text.png" alt=""></div>
                    </div>
                    <form class="formWrapper">
                        <!-- login form -->
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="text" class="inputClass" name="" placeholder="E-mail address">
                                <span class="errorMsg">Invalid e-mail address <span class="removeMsg"><img src="assets/images/cross.svg" alt=""></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="password" class="inputClass" name="" placeholder="Temporary password">
                                <span class="errorMsg">Invalid password<span class="removeMsg"><img src="assets/images/cross.svg" alt=""></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="password" class="inputClass" name="" placeholder="Create new password">
                                <span class="errorMsg">Invalid password<span class="removeMsg"><img src="assets/images/cross.svg" alt=""></span></span>
                            </div>
                        </div>
                        <div class="buttonWrap">
                            <button type="button" class="customBtn" data-ripple> <span> Reset password</span></button>
                        </div>
                    </form>
                </div>
                <!-- register Wrapper end -->
            </div>
        </div>
    </div>
</div>

<div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog registerModal signupModal">
        <!-- Modal content-->
        <div class="modal-content">
            <h1 class="modalHeading">Sign up</h1>
            <div class="modal-body">
                <div class="registerWrapper clearfix">
                    <div class="bannerImage">
                        <div class="logoIcon"><img src="{{url('/')}}/public/web/assets/images/logo-icon.png" alt=""></div>
                        <div class="logoText"><img src="{{url('/')}}/public/web/assets/images/logo-text.png" alt=""></div>
                    </div>
                   <!-- <form class="formWrapper" id="signupId" action="signup" method="Post"> -->
                    {!! Form::open(['url' => 'signup','class'=>'formWrapper','id'=>'signupId']) !!}
                    
                        <!-- social login  -->
                        <div class="form-group">
                            <a href="{{ url('/auth/google') }}" target="_blank" class="socialLogin withGoogle" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/google.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Google</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" class="socialLogin withYahoo" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/yahoo.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Yahoo</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/auth/facebook') }}" target="_blank" class="socialLogin withFacebook" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/facebook.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in with Facebook</span>
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/auth/twitter') }}"  target="_blank" class="socialLogin withTwitter" data-ripple>
                                <span class="icon"><img src="{{url('/')}}/public/web/assets/images/twitter.svg" alt=""></span>
                                <span class="arrowShift"></span>
                                <span class="text">Log in withsubmit Twitter</span>
                            </a>
                        </div>
                        <!-- social login end -->
                        <div class="devider">or</div>
                        <!-- login form -->
                         <!--***************Error Message****************-->
                          @if(Session::has('webError'))  
                        <span class="devider" id="signupError"> {{Session::get('webError')}}</span>
                        {{Session::forget('webError')}}
                         @endif
                          <!--***************Error Message End****************-->

                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="text" maxlength="30" class="inputClass" name="signupEmail" placeholder="E-mail address" value="{{ old('signupEmail') }}">
                        <span class="errorMsg @if ($errors->has('signupEmail')) {{"open"}}  @endif" > <span id="signupEmailError" class="errorClass"> 
                         @if ($errors->has('signupEmail'))
                            {{ $errors->first('signupEmail') }}
                            @endif
                        </span><span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
                           
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="password" maxlength="30" class="inputClass" name="signupPassword" placeholder="Password">
                            <span class="errorMsg @if ($errors->has('signupPassword')) {{"open"}}  @endif" > <span id="signupPasswordError">
                            @if ($errors->has('signupPassword'))
                            {{ $errors->first('signupPassword') }}
                            @endif
                            </span><span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
          
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inputWrap">
                                <input type="text" maxlength="20" class="inputClass" name="signupUserName" placeholder="Username" value="{{ old('signupUserName') }}">
                                <span class="errorMsg @if ($errors->has('signupUserName')) {{"open"}}  @endif" > <span id="signupUserError">
                                @if ($errors->has('signupUserName'))
                                {{ $errors->first('signupUserName') }}
                                @endif
                                </span><span class="removeMsg"><img src="{{url('/')}}/public/web/assets/images/cross.svg" alt=""></span></span>
          
                                <a href="javascript:void(0);" class="changeName textHover">Change</a>
                            </div>
                        </div>
                        <p class="termsText">By signing up you agree to Caltex Music’s <a href="javascript:void(0);" data-toggle="modal" data-target="#privacyModal" data-dismiss="modal"> Terms & Conditions</a> and <a href="javascript:void(0);" data-toggle="modal" data-target="#termsModal" data-dismiss="modal"> Privacy Policy</a>
                        </p>
                        <div class="buttonWrap">
                            <button type="submit" class="customBtn" data-ripple id="signupBtnId"> <span> Sign up</span></button>
                        </div>
                        <!-- login form end -->
                   <!--  </form> -->
                   {!! Form::close() !!}
                </div>
                <!-- register Wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- modals end -->