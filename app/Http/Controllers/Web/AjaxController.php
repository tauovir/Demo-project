<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebModel\Customer;
use App\Helpers\CommonHelper;
use Validator;

class AjaxController extends Controller {

    public function suggestedUserName(Request $request) {
        $message = ['email.required' => trans('signup.emailRequired'),
            'email.max' => trans('signup.emailMax'),
            'email.email' => trans('signup.emailEmail'),
            'email.unique' => trans('signup.emailAlreadyExist'),
        ];

        $validator = Validator::make($request->all(), [
                    'email' => 'required|max:50|email|unique:customers,cust_email',
                        ], $message);
        if ($validator->fails()) {
            return response()->json(CommonHelper::displayMessage(config('ErrorCodes.FAIL'), $validator->messages()->first()));
        }
        $email = $request->email;
        $userName = CommonHelper::suggestedName($email);
        $temp['userName'] = $userName;
        return response()->json(CommonHelper::displayMessage(config('ErrorCodes.SUCCESS'), trans('webMessages.success'), $temp));
    }

    public function checkUSerOrEmail(Request $request) {
        $flag = "true";
        if ($request->type == 1) { // type =1 for email
            $condition = ['cust_email' => $request->signupEmail];
            if (Customer::isExist($condition)) {
                $flag = "false";
            }
        } else if ($request->type == 2) { // type =2 for User Name
            $condition = ['cust_username' => $request->signupUserName];
            if (Customer::isExist($condition)) {
                $flag = "false";
            }
        }
        else if ($request->type == 3) { // type =3 for login email.if email not exist we do not allow user submit form
            $condition = ['cust_email' => $request->email];
            if (!Customer::isExist($condition)) {
                $flag = "false";
            }
        }
        echo  $flag;exit;
    }

}
