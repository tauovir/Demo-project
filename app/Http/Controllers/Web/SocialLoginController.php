<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\WebModel\Customer;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Session;
//require("App\Liberary\yahoo\Yahoo.inc");

class SocialLoginController extends Controller {

    /**
     * @Description: This Function is responsible for authenticating Socail login via Oauth process
     * If authentication success then it goes to handleProviderCallback other wise it goes to exception
     * @param type $provider (facebook,google,twitter)
     * @return type
     */
    public function redirectToProvider($provider) {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $ex) {
            Session::flash('webError', trans('webMessages.socialLoginError'));
       return redirect()->back(); 
        }
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider) {

        $socialprovider = '';
        switch ($provider) {
            case 'facebook':
                $socialprovider = 'cust_facebook_id';
                break;
            case 'google':
                $socialprovider = 'cust_google_id';
                break;
            case 'twitter':
                $socialprovider = 'cust_twitter_id';
                break;
        }
        try {
           
            $user = Socialite::driver($provider)->user();
            $flag = $this->findOrCreateUser($user, $socialprovider);

            $condition = [$socialprovider => $user->id];
            $profileData = Customer::profileData($condition);
           // Auth::guard('customers')->login($profileData, true);
            Auth::guard('customers')->loginUsingId($profileData->cust_id);
            return redirect()->intended('/');
        } catch (\Exception $ex) {
           
            //Session::flash('webError', trans('webMessages.exception'));
            return redirect()->back(); 
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $socialprovider) {
        $condition = [$socialprovider => $user->id];
        $authUser = Customer::isExist($condition);
        if (!$authUser) {
            if ($user->email) {
                $condition = ['cust_email' => $user->email];
                $authUser = Customer::isExist($condition);
            }
        }
        if ($authUser) {
            $updateField[$socialprovider] = $user->id;
            $cond['cust_id'] = $authUser->cust_id;
            return Customer::updateField($updateField, $cond);
        } else {
            $model = new Customer();
            $model->$socialprovider = $user->id;
            $model->cust_email = isset($user->email) ? $user->email : '';
            return $model->save();
        }
    }

    
    
}
