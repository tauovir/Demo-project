<!--============ERROR AND SUCCESS END=============-->
 @if(Session::has('webSuccess'))  
                     <div class="alert alert-success">
                    {{Session::get('webSuccess')}}
                    </div>
                    {{Session::forget('webSuccess')}}
                     @endif
                        <span id="cur_pass_msg" id="cur_pass_msg" style="color:red;font-size: 12px">
                                             @if(Session::has('webError'))  
                                             {{Session::get('webError')}}
                                            {{Session::forget('webError')}}
                                            @endif
                                            </span>
            <div class="form-wrapper">
                <form method="POST" method="POST" action="{{url('/')}}/reset-password">
                  <input type="hidden" name="token" value="{{$token}}">
                     {{ csrf_field() }}
                    <h1>Reset Passoword</h1>     
                    <h2 class="form-title">To reset you password Please fill the fields below.</h2>
                    <div class="form-group">
                        <label>Temproray password</label>  
                        <input id="password" type="text" class="form-control" maxlength="6" name="temp_password"   value="{{ old('temp_password') }}">
                        <span class="form-icon"><i class="fa fa-lock"></i></span>
                       <span style="color:red">{{ $errors->first('temp_password')}} </span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>  
                        <input id="password" type="password" class="form-control" maxlength="30" name="password" required>

                        <span class="form-icon"><i class="fa fa-lock"></i></span>
                        
                    </div>
                    <div class="form-group">
                       <label>Confirm Password</label>  
                       <input id="password-confirm" type="password" class="form-control" maxlength="30" name="password_confirmation" required>
                        <span class="form-icon"><i class="fa fa-lock"></i></span>
                        
                    </div>
                    <div class="form-group">
                        <button class="form-btn save" type="submit">Reset</button>
                    </div>
                    <p class="back-tosign">
                        <a href="{{url('/')}}">Back to Sign in?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!-- ============== Login Section End ============== -->