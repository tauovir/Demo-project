<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Helpers\CommonHelper;
use App\ApiModel\CustomerPresence;
use Illuminate\Contracts\Encryption\DecryptException;

/* * *******************************
 * @Description: This class used to maintain customer presence in app from app open to  last active
 * 
 * ********************************* */

class CustomerPresences extends Controller {

    /**
     * @SWG\Post(path="/last-active-time",
     *   tags={"LastPresence"},
     *   summary="Last Presence",
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
     *     name="active_time",
     *     in="formData",
     *     description="YYYY-MM-DD H:i:s",
     *     type="string",
     *     required=true
     *   ),
     *  @SWG\Parameter(
     *     name="last_active_time",
     *     in="formData",
     *     description="YYYY-MM-DD H:i:s",
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
     *     name="accessToken",
     *     in="formData",
     *     description="Access Token",
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
    /**
     * @Description: Store user last presence in app
     * @param Request $request
     * @return type:json
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'device_id' => 'required|max:100',
                    'platform' => 'required|integer|in:1,2',
                    'active_time' => 'required|date_format:Y-m-d H:i:s',
                    'last_active_time' => 'required|date_format:Y-m-d H:i:s',
        ]);
        $custId = 0;
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.PARAM_MISSING'), $validator->messages()->first()));
        }
        try {
            if ($request->has('accessToken')) {
                $accessToken = $request->accessToken;
                $decryptAccessToken = decrypt($accessToken);
                $userData = CustomerSession::getSessionData($decryptAccessToken); // Get Session data
                $custId = $userData->cust_id;
            }
            $condition = ['device_id' => $request->device_id];
            $sessionExist = CustomerPresence::isPresenceExist($condition);
            if ($sessionExist) {
                $updateFiled['platform'] = $request->platform;
                $updateFiled['active_time'] = $request->active_time;
                $updateFiled['active_time'] = $request->active_time;
                $updateFiled['cust_id'] = $custId;
                CustomerPresence::isPresenceExist($updateFiled, $condition);
            } else {

                $presenceModel = new CustomerPresence();
                $presenceModel->device_id = $request->device_id;
                $presenceModel->platform = $request->platform;
                $presenceModel->active_time = $request->active_time;
                $presenceModel->last_active_time = $request->last_active_time;
                $presenceModel->save();
            }
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.success')));
        } catch (DecryptException $e) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.invalidToken')));
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure')));
        }
    }

}
