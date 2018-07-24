<?php

namespace App\Http\Controllers\Apiv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ApiModel\Country;
use App\Helpers\CommonHelper;
class CountriesController extends Controller
{
   
    
 /**
     * @SWG\Get(path="/country-list",
     *   tags={"Countries"},
     *   summary="Get All active country",
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
   
    public function getCountries()
    {
        $countryList = Country::getActiveCountries();
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('apiMessages.success'), $countryList));    
    }
}
