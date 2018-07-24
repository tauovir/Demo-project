<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CommonHelper;
use App\ApiModel\Customer;
use App\ApiModel\CustomerSession;
use Illuminate\Support\Facades\Hash;
use Validator;
class CustomerController extends Controller {

    /**
     * @SWG\Post(path="/update-profile",
     *   tags={"Customer"},
     *   summary="Profile Update",
     *   description="Profile update",
     *   operationId="Profile Update",
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
     *    @SWG\Parameter(
     *     name="accessToken",
     *     in="header",
     *     description="AccessToken",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="cust_dob",
     *     in="formData",
     *     description="Date of birth",
     *     type="string",
     *   ),
     *   @SWG\Parameter(
     *     name="cust_phone",
     *     in="formData",
     *     description="Phone",
     *     type="string",
     *   ),
    *  @SWG\Parameter(
     *     name="country_id",
     *     in="formData",
     *     description="Country Id",
     *     type="number",
     *   ),
    *  @SWG\Parameter(
     *     name="cust_state",
     *     in="formData",
     *     description="State",
     *     type="string",
     *   ),
     *  @SWG\Parameter(
     *     name="cust_city",
     *     in="formData",
     *     description="City ",
     *     type="number",
     *   ),
     *  @SWG\Parameter(
     *     name="cust_gender",
     *     in="formData",
     *     description="Gender",
     *     type="number",
     *   ),
     *  @SWG\Parameter(
     *     name="cust_zipcode",
     *     in="formData",
     *     description="Zipcode",
     *     type="string",
     *   ),
    * @SWG\Response(response=200, description="Successfully executed"),
    * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=204, description="Api token invalid"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=205, description="Your account is in active"),
     *  @SWG\Response(response=206, description="Your account has been blocked"),
     * @SWG\Response(response=500, description="Internal server Error "),
    
     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "},
     *              "Api token": {"accessToken: ", "***********: "}
     *         }
     *     },
     * )
     */
    public function updareProfile(Request $request) {
        
        $stdObj = new \stdClass();
        $validator = Validator::make($request->all(), [
                    'cust_dob' => 'sometimes|date_format:Y-m-d',
                    'country_id' => 'sometimes|string|max:3',
                    'cust_state' => 'sometimes|max:50',
                    'cust_city' => 'sometimes|max:50',
                    'cust_gender' => 'sometimes|numeric||in:1,2,3',
                    'profile_pic' => 'sometimes|image|mimes:jpg,png|max:2000',  // 2MB
        ]);
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }
        if ($request->hasFile('profile_pic')) {
             $file = $request->file('profile_pic'); 
             $path = \Storage::disk('user_profile')->put('userImage', $file);
             $updateData['cust_profile_pic'] = $path;
        }
        
        try {
            $sesstionData = $request->sessionData; // Set from middleware
            if ($request->has('cust_dob')) {
                $updateData['cust_dob'] = $request->cust_dob;  
            }
            if ($request->has('country_id')) {
                $updateData['country_id'] = $request->country_id;
            }
            if ($request->has('cust_state')) {
                $updateData['cust_state'] = $request->cust_state;
            }
            if ($request->has('cust_city')) {
                 $updateData['cust_city'] = $request->cust_city;
            }
            if ($request->has('cust_gender')) {
                $updateData['cust_gender'] = $request->cust_gender;
            }
            if ($request->has('cust_phone')) {
                $updateData['cust_phone'] = $request->cust_phone;
            }
            if ($request->has('cust_zipcode')) {
                $updateData['cust_zipcode'] = $request->cust_zipcode;
            }
            $condtion['cust_id'] =$sesstionData->cust_id;
                Customer::updateField($updateData, $condtion);
                $pfofileData = Customer::profileData($sesstionData->cust_id);
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.profileUpdate'), $pfofileData));
         
        } catch (\Exception $ex) {
  //  return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));
    return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), $ex->getMessage(), $stdObj));


        }
    }

 
    /**
     * @SWG\Post(path="/change-password",
     *   tags={"Customer"},
     *   summary="Change passwrod",
     *   description="Change password",
     *   operationId="Change password",
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
     *    @SWG\Parameter(
     *     name="accessToken",
     *     in="header",
     *     description="AccessToken",
     *     type="string",
     *     required=true
     *   ),
    *  @SWG\Parameter(
     *     name="old_password",
     *     in="formData",
     *     description="Country Id",
     *     type="number",
     *     required=true
     *   ),
    *  @SWG\Parameter(
     *     name="new_password",
     *     in="formData",
     *     description="State",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="repaet_password",
     *     in="formData",
     *     description="Gender",
     *     type="number",
     *     required=true
     *   ),
    * @SWG\Response(response=200, description="Successfully executed"),
    * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=204, description="Api token invalid"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=205, description="Your account is in active"),
     *  @SWG\Response(response=206, description="Your account has been blocked"),
     * @SWG\Response(response=500, description="Internal server Error "),
    
     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "},
     *              "Api token": {"accessToken: ", "***********: "}
     *         }
     *     },
     * )
     */   
    
    public function changePassword(Request $request) {
        $stdObj = new \stdClass();
        $validator = Validator::make($request->all(), [
                    'current_password' => 'required|max:50',
                    'new_password' => 'required|max:50',
                   'repeat_password' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first(), $stdObj));
        }
        try {
         $sesstionData = $request->sessionData; // Set from middleware
         if ($request->new_password != $request->repeat_password) {
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.passwordRepeatPassword'), $stdObj));
        }
      if (!Hash::check(trim($request->current_password), $sesstionData->cust_password_encrypt)) {
          return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.currentPasswordNotMatched'), $stdObj));
      }
     
        $updateData['cust_password_encrypt'] = bcrypt(trim($request->new_password));
       
        $condtion['cust_id'] =$sesstionData->cust_id; 
        Customer::updateField($updateData,$condtion);
       return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.passwordChanged'), $stdObj));
         
        } catch (\Exception $ex) {
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));

        } 
        
    }
    
    
    /**
     * @SWG\Get(path="/logout",
     *   tags={"Customer"},
     *   summary="logout",
     *   description="logout",
     *   operationId="logout",
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
     *
     * @SWG\Parameter(
     *     name="accessToken",
     *     in="header",
     *     description="User Access Token for accessing Api",
     *     type="string",
     *     required=true
     *   ),
     * @SWG\Response(response=200, description="Successfully executed"),
    * @SWG\Response(response=201, description="fail to execute"),
     * @SWG\Response(response=202, description="Require parameter missing or problem"),
     * @SWG\Response(response=204, description="Api token invalid"),
     * @SWG\Response(response=203, description="Basic Authentication fail"),
     * @SWG\Response(response=205, description="Your account is in active"),
     *  @SWG\Response(response=206, description="Your account has been blocked"),
     * @SWG\Response(response=500, description="Internal server Error "),
      
     *   security={
     *         {
     *             "basicAuth": {"Username: ", "Password: "}
     *         }
     *     },
     * )
     */
     public function logout(Request $request) {
               $sesstionData = $request->sessionData; // Set from middleware
               $stdObj = new \stdClass();
                try {
             $condi['device_id'] = $sesstionData->device_id;
            CustomerSession::logoutSession($condi);
           return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.logout'), $stdObj));
             } catch (\Exception $e) {
           return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure'), $stdObj));

                }
           
        
     
  } 
    
    
    
}
