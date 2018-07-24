<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use App\Helpers\CommonHelper;
use App\ApiModel\Customer;
use App\ApiModel\CustomerSession;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordLink;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Encryption\DecryptException;
use Mail;

class AuthenticatesController extends Controller
{

    /**
     * @SWG\Post(path="/signup",
     *   tags={"Registration"},
     *   summary="Customer registration",
     *   description="New registration",
     *   operationId="Registration",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     *  
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),

     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="formData",
     *     description="email",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="cust_username",
     *     in="formData",
     *     description="user name",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="password",
     *     type="string",
     *     required=true
     *   ),

     *  @SWG\Parameter(
     *     name="device_id",
     *     in="formData",
     *     description="device id",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="platform",
     *     in="formData",
     *     description="1=>android,2=>ios",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_token",
     *     in="formData",
     *     description="Device Token",
     *     type="string",
     *   ),
     *  @SWG\Parameter(
     *     name="lang",
     *     in="formData",
     *     description="en",
     *     type="string",
     *   ),
     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),
     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function signup(Request $request)
    {
        $stdObj = new \stdClass();
        $attributeNames = array(
            'cust_email' => 'Email',
            'cust_username' => 'User name',
        );
        $validator = Validator::make($request->all(), [
            'cust_email' => 'required|max:50|email|unique:customers,cust_email',
            'cust_username' => 'required|min:3|max:15|unique:customers,cust_username',
            'password' => 'required|max:20|min:6',
            'device_id' => 'required|max:200',
            'platform' => 'required|integer|in:1,2',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message

        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }

        try {
            $CustomerModel = new Customer();
            $CustomerModel->cust_email = trim($request->cust_email);
            $CustomerModel->cust_username = $request->cust_username;
            $CustomerModel->cust_password_encrypt = bcrypt(trim($request->password));
            $CustomerModel->cust_join_IP = request()->ip();
            if ($CustomerModel->save()) {
                $accessToken = $this->storeSessionData($request, $CustomerModel->id, request()->ip(), true);
                $pfofileData = Customer::profileData($CustomerModel->id);
                $pfofileData->accessToken = $accessToken;
                //========Send Welcome Mail to newly created account=============
                $email = trim($request->cust_email);
                $mailData = ['name' => $request->cust_username];
                Mail::to($email)->send(new WelcomeMail($mailData));

                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.signupSuccess'), $pfofileData));
            } else {
                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.serverSideError'), $stdObj));
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));
        }
    }

    /**
     * @SWG\Post(path="/login",
     *   tags={"Registration"},
     *   summary="Customer Login",
     *   description="Login",
     *   operationId="Customer login",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="formData",
     *     description="email",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="password",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_id",
     *     in="formData",
     *     description="device id",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="platform",
     *     in="formData",
     *     description="1=>android,2=>ios",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_token",
     *     in="formData",
     *     description="Device Token",
     *     type="string",
     *   ),
     *  @SWG\Parameter(
     *     name="lang",
     *     in="formData",
     *     description="en",
     *     type="string",
     *   ),
     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function login(Request $request)
    {
        $stdObj = new \stdClass();
        $attributeNames = array(
            'cust_email' => 'Email',
        );
        $validator = Validator::make($request->all(), [
            'cust_email' => 'required|max:100',
            'password' => 'required|max:20|min:6',
            'device_id' => 'required|max:200',
            'platform' => 'required|integer|in:1,2',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }

        try {
            $condition = ['cust_email' => trim($request->cust_email)];
            $UserData = Customer::isExist($condition);
            if (!$UserData) {
                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.emailNotExist'), $stdObj));
            }
            if (Hash::check(trim($request->password), $UserData->cust_password_encrypt)) {
                //==========Check Customer Active or block====== 
                if ($UserData->cust_status == Config('AppConstant.INACTIVE')) {
                    return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.accountInactive'), $stdObj));
                } else if ($UserData->cust_is_active == Config('AppConstant.BLOCK')) {
                    return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.accountBlock'), $stdObj));
                }
                $accessToken = $this->storeSessionData($request, $UserData->cust_id, request()->ip(), false);
                $pfofileData = Customer::profileData($UserData->cust_id);
                $pfofileData->accessToken = $accessToken;

                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.loginSuccess'), $pfofileData));
            } else {
                return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.invalidCredential'), $stdObj));
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));
        }
    }

    /**
     * @SWG\Post(path="/social-login",
     *   tags={"Registration"},
     *   summary="Social Login",
     *   description="Social Login",
     *   operationId="Social login",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="formData",
     *     description="email",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="social_id",
     *     in="formData",
     *     description="Social Id",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_id",
     *     in="formData",
     *     description="device id",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="platform",
     *     in="formData",
     *     description="1=>android,2=>ios",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="login_type",
     *     in="formData",
     *     description="2=>facebook,3=>google,4=>twitter5=>yahoo",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_token",
     *     in="formData",
     *     description="Device Token",
     *     type="string",
     *   ),
     *  @SWG\Parameter(
     *     name="lang",
     *     in="formData",
     *     description="en",
     *     type="string",
     *   ),
     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function socialLogin(Request $request)
    {
        $stdObj = new \stdClass();
        $CustomerModel = new Customer();
        $attributeNames = array(
            'cust_email' => 'Email',
        );
        $custId = 0;
        $isNew = true; // Denoting is user login/signup first time ? if yes so we send mail to first time user
        $validator = Validator::make($request->all(), [
            'social_id' => 'required|max:200',
            'cust_email' => 'sometimes|email',
            'device_id' => 'required|max:200',
            'platform' => 'required|integer|in:1,2',
            'login_type' => 'required|integer|in:2,3,4,5',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }

        $socialId = 'cust_facebook_id';
        if ($request->login_type == Config('AppConstant.LOGIN_TYPE.FACEBOOK')) {
            $socialId = 'cust_facebook_id';
        } else if ($request->login_type == Config('AppConstant.LOGIN_TYPE.GOOGLE')) {
            $socialId = 'cust_google_id';
        } else if ($request->login_type == Config('AppConstant.LOGIN_TYPE.TWITTER')) {
            $socialId = 'cust_twitter_id';
        } else if ($request->login_type == Config('AppConstant.LOGIN_TYPE.YAHOO')) {
            $socialId = 'cust_yahoo_id';
        }
        $condition = [$socialId => $request->social_id];
        try {
            $UserData = Customer::isExist($condition);
            if (!$UserData) {
                $condition = ['cust_email' => $request->cust_email];
                $UserData = Customer::isExist($condition);
            }
            if (!$UserData) {
                $CustomerModel->cust_email = trim($request->cust_email);
                $CustomerModel->cust_join_IP = request()->ip();
                $CustomerModel->$socialId = $request->social_id;
                $CustomerModel->save();
                $custId = $CustomerModel->id;
            } else {
                //=========Check is Customer active or block===============    
                if ($UserData->cust_status == Config('AppConstant.INACTIVE')) {
                    return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.accountInactive'), $stdObj));
                } else if ($UserData->cust_is_active == Config('AppConstant.BLOCK')) {
                    return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.accountBlock'), $stdObj));
                }
                //=========update key==============
                $updateFile = [];
                $updateFile[$socialId] = $request->social_id;
                $updateFile['cust_join_IP'] = request()->ip();
                $condition['cust_id'] = $UserData->cust_id;
                Customer::updateField($updateFile, $condition);
                //=========update key==============
                $custId = $UserData->cust_id;
                $isNew = false; // denoting it is existing User
            }
            $accessToken = $this->storeSessionData($request, $custId, request()->ip(), $isNew);
            $pfofileData = Customer::profileData($custId);
            $pfofileData->accessToken = $accessToken;
            $pfofileData->is_new = $isNew;  // Set this flag so App-end redirect screen
            //========Send Welcome Mail to newly created account=============
            if ($isNew) {
                $email = trim($request->cust_email);
                $mailData = ['name' => 'User'];
                Mail::to($email)->send(new WelcomeMail($mailData));
            }
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.loginSuccess'), $pfofileData));
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));
        }
    }

    /**
     * @Description: Store/Update Session Data to customer session
     * @param type $data
     * @param type $custId
     * @return type
     */
    public function storeSessionData(Request $data, int $custId, string $ipAddress, int $isNew) : string
    {
        $sessionData = new CustomerSession();
        $randomStr = CommonHelper::randomString(config('AppConstant.RANDOM_STR_LENGTH'));
        $accessToken = Crypt::encrypt($randomStr);
        if (!$isNew) {   // If Session exist so updated sessioin with new data
            $condition = ['cust_id' => $custId, 'device_id' => $data->device_id];
            $sessionExist = CustomerSession::isSessionExist($condition);
            if ($sessionExist) {
                $updateFiled['device_token'] = ($data->has('device_token') ? $data->device_token : '');
                $updateFiled['platform'] = $data->platform;
                $updateFiled['lang'] = ($data->has('lang') ? $data->lang : Config('AppConstant.LANGUAGE_TYPE.ENGLISH'));
                $updateFiled['login_type'] = ($data->has('login_type') ? $data->login_type : Config('AppConstant.LOGIN_TYPE.NORMAL'));
                $updateFiled['created_at'] = date('Y-m-d H:i:s');
                $updateFiled['api_token'] = $randomStr;
                CustomerSession::updateSession($updateFiled, $condition);
                return $accessToken;
            }
        }
        $sessionData->device_id = $data->device_id;
        $sessionData->device_token = ($data->has('device_token') ? $data->device_token : '');
        $sessionData->platform = $data->platform;
        $sessionData->lang = ($data->has('lang') ? $data->lang : Config('AppConstant.LANGUAGE_TYPE.ENGLISH'));
        $sessionData->login_type = ($data->has('login_type') ? $data->login_type : Config('AppConstant.LOGIN_TYPE.NORMAL'));
        $sessionData->cust_id = $custId;
        $sessionData->ip_address = $ipAddress;
        $sessionData->api_token = $randomStr;
        $sessionData->save();
        return $accessToken;
    }

    /**
     * @SWG\Get(path="/forgot-password",
     *   tags={"Password"},
     *   summary="Forgot password",
     *   description="Forgot password",
     *   operationId="Forgot password",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="query",
     *     description="email",
     *     type="string",
     *     required=true
     *   ),

     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function forgotPassword(Request $request)
    {
        $attributeNames = array(
            'cust_email' => 'Email',
        );
        $validator = Validator::make($request->all(), [
            'cust_email' => 'required|max:50|email',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first()));
        }

        $condition = ['cust_email' => $request->cust_email];
        $userData = Customer::isExist($condition);
        if (!$userData) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.emailNotExist')));
        }
        try {
            $tempCode = rand(99999, 999999);
            $randomStr = CommonHelper::randomString(config('AppConstant.RANDOM_STR_LENGTH'));
            $token = Crypt::encrypt($randomStr);
            $link = url('/') . '/reset/' . $token;
            $email = $userData->cust_email;
            $temp['name'] = ucwords($userData->cust_first_name . ' ' . $userData->cust_last_name);
            $temp['url'] = $link;
            $temp['tempory_code'] = $tempCode;
            $updateFile = [];
            $updateFile['cust_reset_password_code'] = $randomStr;
            $updateFile['cust_temp_reset_code'] = $tempCode;
            $updateFile['cust_password_code_expire'] = time();
            Customer::updateField($updateFile, $condition);
            Mail::to($email)->send(new ResetPasswordLink($temp));

            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.resetpasswordLink')));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            exit;
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure')));
        }
    }

    /**
     * @SWG\Post(path="/reset-password",
     *   tags={"Password"},
     *   summary="Forgot password",
     *   description="Forgot password",
     *   operationId="Forgot password",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     *
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="formData",
     *     description="Email",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="password",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="temporary_password",
     *     in="formData",
     *     description="Temporary password",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_id",
     *     in="formData",
     *     description="device id",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="platform",
     *     in="formData",
     *     description="1=>android,2=>ios",
     *     type="number",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="device_token",
     *     in="formData",
     *     description="Device Token",
     *     type="string",
     *   ),
     *  @SWG\Parameter(
     *     name="lang",
     *     in="formData",
     *     description="en",
     *     type="number",
     *   ),
     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
  
    /******************************************
     * @Description: Check temporary password expire or not
     * @param type $userData
     * @return boolean
     ******************************************/  
  /* public function checkExpiryTempPass(Customer $userData):bool {
     
     /*  $time = $userData->cust_password_code_expire;
       $settingData = AdminSetting::getAdminSettingData();
       $curTime = time();
       $expireTime = $userData->cust_password_code_expire + $settingData->reset_password_expiry * 60 * 60; // in Second
     //========Now check expiry=============
       if($expireTime < $curTime) {
         return false;
       }
       return true;
        
  }   */



    /**
     * @SWG\Get(path="/check-email",
     *   tags={"Registration"},
     *   summary="Registration",
     *   description="Registrations",
     *   operationId="Registration",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_email",
     *     in="query",
     *     description="Email",
     *     type="string",
     *     required=true
     *   ),

     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function isEmailExist(Request $request)
    {
        $stdObj = new \stdClass();
        $attributeNames = array(
            'cust_email' => 'Email',
        );
        $validator = Validator::make($request->all(), [
            'cust_email' => 'required|max:50|email',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }
        $condition = ['cust_email' => trim($request->cust_email)];
        $emailData = Customer::isExist($condition);
        if ($emailData) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.emialExist'), $stdObj));
        }

        $stdObj->sugested_name = $this->suggestedName($request->cust_email);
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.success'), $stdObj));
    }

    public function suggestedName(string $email)
    {
        $flag = false;
        $arr = explode('@', $email);
        if (count($arr) > 0) {
            $userName = trim($arr[0]);;

            if (strlen($userName) < 3) {
                $tempCode = rand(1, 999);
                $userName = $userName . "_" . $tempCode;
            }

            $condition = ['cust_username' => $userName];
            $isExist = Customer::isExist($condition);
            if (!$isExist) {
                return $userName;
            }
            while ($flag == false) {
                $tempCode = rand(1, 999);
                $userName = $userName . "_" . $tempCode;
                $condition = ['cust_username' => $userName];
                $isExist = Customer::isExist($condition);
                if (!$isExist) {
                    $flag = true;
                }

            }
            return $userName;
        }

    }

    /**
     * @SWG\Get(path="/check-username",
     *   tags={"Registration"},
     *   summary="Registration",
     *   description="Registrations",
     *   operationId="Registration",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
     *  @SWG\Parameter(
     *     name="cust_username",
     *     in="query",
     *     description="user name",
     *     type="string",
     *     required=true
     *   ),

     * @SWG\Response(response=200, description="Successfully executed"),
     * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=500, description="Internal server Error "),

     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
    public function isUserNameExist(Request $request)
    {
        $attributeNames = array(
            'cust_username' => 'User name',
        );
        $validator = Validator::make($request->all(), [
            'cust_username' => 'required|max:50',
        ]);
        $validator->setAttributeNames($attributeNames); // Custome Attribute name for dispalying message
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first()));
        }
        $condition = ['cust_username' => trim($request->cust_username)];
        $emailData = Customer::isExist($condition);
        if ($emailData) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.userNameExist')));
        }
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.success')));
    }

}
