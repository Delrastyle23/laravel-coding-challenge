<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferralController extends Controller
{
    //

    public function validateEmail(Request $request){
        
        if($request->email){
            $validator = Validator::make($request->all(), [
                'email'=>'required|email|unique:referrals|unique:users'
            ]);

           
            if(!$validator->fails()){
                if(is_array($request->email_list)){
                    if(in_array($request->email, $request->email_list)){
                        return response()->json('Duplicate email', 404);
                    }
                }
                return '<tr>'.
                        '<td class="email-text">'.$request->email.'</td>'.
                       '</tr>';
            }
        }
        return response()->json('Invalid email', 404);
        
    }
}
