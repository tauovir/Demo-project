<?php

namespace App\Http\Controllers\Apiv1;

use App\Http\Controllers\Controller;
use App\ApiModel\Language;
use App\Helpers\CommonHelper;

/***************************************
 * Description: This class is basically for language pupose and cantian all method which is related to language
 * 
 **************************************/
class Languages extends Controller
{
   
     /**
     * @SWG\Get(path="/language",
     *   tags={"Languages"},
     *   summary="Get All active Languages",
     *   description="Get All active country",
     *   operationId="Country",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     * @SWG\Parameter(
     * name = "Authorization",
     * in = "header",
     * type = "string",
     * description = "Basic Auth",
     * required = true
     * ),
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
  /**************************************************
   * @Description : Get All active language 
   * Date : 21-05-2018
   * @return Json
   *************************************************/ 
    
    public function getLanguages() {
      try {  
        $list = Language::getActiveLanguage();
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.success'), $list));
        } catch (\Exception $ex) {
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure')));

        }
        
    }
    
}
