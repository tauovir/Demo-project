<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use App\WebModel\Customer;
use App\WebModel\AdminSetting;
use Validator;
use Session;
class ResetPasswordController extends Controller
{
   
 /**
  * @Description: First check token and expiry of this token then proceed ahead
  * @param Request $request
  * @return type
  */   
  public function resetDeeplink() {
   return view('deeplink.resetPassword');
  }  
  
  /**
   * @Description:
   * @param Request $request
   * @return type
   */
  
   public function showForm(Request $request) 
   {
       try{
         $decryptAccessToken =decrypt($request->token); 
          $condition = ['cust_reset_password_code' => $decryptAccessToken];
        $userData = Customer::isExist($condition);
        if (!$userData) {
           abort('404');
        }
      
        return view('web.password.reset')->with('token',$request->token)->with('email',$userData->cust_email);
       }catch (DecryptException $e) {
        abort('404');
        }
   }
   
  /**
   * @Description: Set Customer new Password
   * @param Request $request
   * @return type:void
   */ 
  
   public function resetPassword(Request $request) 
   {
        $validator = Validator::make($request->all(), [
                    'temp_password' => 'required|max:6',
                    'password' => 'required',
                    'token' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withInput()->withErrors($validator);
        }
       try {
         $decryptAccessToken =decrypt($request->token); 
        $condition = ['cust_reset_password_code' => $decryptAccessToken];
        $userData = Customer::isExist($condition);
        if (!$userData) {
           abort('404');      
        }
        //***********Check given temporary password is coorect or not***************
        if($userData->cust_temp_reset_code != $request->temp_password) {
            Session::flash('webError', trans('webMessages.temporaryCodeinvalid'));
            return redirect()->back()->withInput()->withErrors($validator);  
        }
            $updateFile = [];
            $condition = ['cust_id' => $userData->cust_id];
            $updateFile['cust_reset_password_code'] = '';
            $updateFile['cust_temp_reset_code'] = 0;
            $updateFile['cust_password_encrypt'] = bcrypt(trim($request->password));
            Customer::updateField($updateFile, $condition);
            Session::flash('webSuccess', trans('webMessages.passwordReset'));
            return redirect('reset-deeplink');  
        }
         catch (DecryptException $e) {
         abort('404');
        }
        catch (\Exception $ex) {
            Session::flash('webError', $ex->getMessage());
            return redirect()->back()->withInput()->withErrors($validator);  
        } 
       
       
     }
  
}
