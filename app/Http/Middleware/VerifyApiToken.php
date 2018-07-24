<?php

namespace App\Http\Middleware;
use App\Helpers\CommonHelper;
use App\ApiModel\CustomerSession;
use Illuminate\Contracts\Encryption\DecryptException;
use Closure;

class VerifyApiToken
{
    /**
     * This Middleware and check Access token if all is perfect then request goes to controller else return back
     *@Date : 10-05-2018
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        if($request->header('accessToken') !=''){
              try {
            $accessToken = $request->header('accessToken');
         
            $decryptAccessToken =decrypt($accessToken);
          
            $userData  = CustomerSession::getSessionData($decryptAccessToken); // Get Session data
       
            if($userData){
              if($userData->cust_status == Config('AppConstant.INACTIVE'))  {
             return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.INACTIVE_ACCOUNT'),trans('apiMessages.inactiveAccount')));
 
              } else  if($userData->cust_status == Config('AppConstant.BLOCK'))  {
                    return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.BLOCKED_ACCOUNT'),trans('apiMessages.blockAccount')));
 
              } else  if($userData->cust_status == Config('AppConstant.DELETED'))  {
                 return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.DELETED_ACCOUNT'),trans('apiMessages.deletedAccount')));
 
              } 
                $request['sessionData'] = $userData; // set data to request so we can get it in controller
                return $next($request);
            }else{
                return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.FAIL'),trans('apiMessages.loginToContinue')));
 
            }
            
             } catch (DecryptException $e) {
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), trans('apiMessages.invalidToken')));
      
        }
        catch (\Exception $ex) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.INTERNAL_SERVER_ERROR'), trans('apiMessages.exceptionOccure')));
        }
            
        }
     return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.FAIL'),trans('apiMessages.tokenMissing')));
    }
    
}
