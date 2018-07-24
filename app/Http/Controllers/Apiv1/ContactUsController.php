<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ApiModel\ContectUs;
use App\Helpers\CommonHelper;
use Validator;
class ContactUsController extends Controller
{
    
     /**
     * @SWG\Post(path="/contact-us",
     *   tags={"ContactUs"},
     *   summary="App user try to contact us",
     *   description="Contact us",
     *   operationId="Contact us",
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
     *     name="message",
     *     in="formData",
     *     description="Contactus description",
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
    public function contactUs(Request $request) {
         $validator = Validator::make($request->all(), [
                    'message' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first()));
        }
        try {
            $sesstionData = $request->sessionData; // Set from middleware
             $model =  new ContectUs();
             $model->message = $request->message;
            $model->cust_id = $sesstionData->cust_id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.receiveContactMessage')));
        } catch (\Exception $ex) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure')));
        }
    }
}
