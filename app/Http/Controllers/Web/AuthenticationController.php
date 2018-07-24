<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebModel\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CommonHelper;
use App\Mail\ResetPasswordLink;
use Validator;
use Session;
use Mail;

/**
 * @Description: This class is responsible for handling login,signup ,forgot password
 * In other word before login user all activity define here, so no auth guard use in this class
 */
class AuthenticationController extends Controller
{
   
/**
 * @Description: Customer normal login
 * Date:24-05-2018
 */
    public function loginCustomer(Request $request)
    {       $message=[ 'email.required' => trans('signup.emailRequired'),
              'email.max' => trans('signup.emailMax'),
               'email.email' => trans('signup.emailEmail'),
              'email.exists' => trans('signup.emailExists'),
              'password.required' => trans('signup.passwordRequired'),
              'password.min' => trans('signup.passwordMin'),
              'password.max' => trans('signup.passwordMax')];
         
            $validator = Validator::make($request->all(), Config('customeValidation.login'),$message);
        if ($validator->fails()) {
             Session::flash('webError', '');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $credentials = ['cust_email'=>$request->email,'password'=>$request->password];

                if (Auth::guard('customers')->attempt($credentials)) {
                if (Auth::guard('customers')->user()->cust_status == Config('AppConstant.INACTIVE')) {
                     Auth::guard('customers')->logout();
                    Session::flash('webError', trans('signup.accountInactive'));
                } else if (Auth::guard('customers')->user()->cust_status == Config('AppConstant.BLOCK')) {
                     Auth::guard('customers')->logout();
                    Session::flash('webError', trans('signup.accountBlock'));
                      }
                return redirect('/');
        } else {
               Session::flash('passwordIncorrect', trans('signup.passwordNotMatched'));
                return redirect()->back()->withInput();
        }
    }
 
/**
 * @Description: Check Customer name/emial already exist in our Database
 * Date : 25-02-2018
 */

    public function checkUser(Request $request)
    {
        $email = $request->email;
        $type = $request->type;
        if ($type == 1) { // If type 1 then check email
            $condition = ['cust_email'=>$email];
            if (Customer::isExist($condition)) {
                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('webMessages.emailAlreadyExist')));
            }
            $userName = CommonHelper::suggestedName($email);
            $temp['userName'] = $userName;
              return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('webMessages.success'),$temp));
        } elseif ($type == 2) { // If type 2 then check User name
            $condition = ['cust_username'=>$email];
            if (Customer::isExist($condition)) {
                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('webMessages.userAlreadyExist')));
            }
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('webMessages.success')));
        }
    }


/**
 * @Description: New Customer Signup
 * @Date : 25-05-2018
 */

    public function signupCustomer(Request $request)
    {
        $attributeNames = array(
          'signupEmail' => 'Email',
          'signupUserName' => 'Username',
          'signupPassword' => 'password',
        );
          $validator = Validator::make($request->all(), [
                  'signupEmail' => 'required|max:50|email|unique:customers,cust_email',
                  'signupUserName' => 'required|min:3|max:15|unique:customers,cust_username',
                  'signupPassword' => 'required|max:20|min:6'
           ]);
            $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
      
        if ($validator->fails()) {
            Session::flash('webError', $validator->messages()->first());
            return redirect()->back()->withInput()->withErrors($validator);
        }
          $model = new Customer();
          $model->cust_email = $request->signupEmail;
          $model->cust_username = $request->signupUserName;
          $model->cust_password_encrypt = bcrypt(trim($request->signupPassword));
        if ($model->save()) {
            Auth::guard('customers')->login($model);
            return redirect('/');
        } else {
            Session::flash('webError', trans('webMessages.invalidCredential'));
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function resetPasswordLink(Request $request)
    {
        $emalFlag = true;
        $validator = Validator::make($request->all(), [
            'email' => 'email',
        ]);
        $email = $request->email;
        if ($validator->fails()) {
            $condition = ['cust_username'=>$email];
            $emalFlag = false;
        } else {
            $condition = ['cust_email'=>$email];
        }
            $userData = Customer::isExist($condition);
        if (!$userData) {
            $message = ($emalFlag == true ? trans('webMessages.emailNotExist') : trans('webMessages.emailNotExist') );    
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('webMessages.userNameNotExist')));
        }
            $tempCode = CommonHelper::temporaryPassword();
            $randomStr = CommonHelper::randomString(config('AppConstant.RANDOM_STR_LENGTH'));
            $token = Crypt::encrypt($randomStr);
            $link = url('/') . '/reset/' . $token;
            $temp['name'] = ucwords($userData->cust_first_name . ' ' . $userData->cust_last_name);
             $temp['url'] = $link;
            $temp['tempory_code'] = $tempCode;
            $updateFile = [];
            $updateFile['cust_reset_password_code'] = $randomStr;
            $updateFile['cust_temp_reset_code'] = $tempCode;
            $updateFile['cust_password_code_expire'] = time();
            Customer::updateField($updateFile, $condition);
            Mail::to($email)->send(new ResetPasswordLink($temp)); 
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('webMessages.resetpasswordLink')));
    }
}
