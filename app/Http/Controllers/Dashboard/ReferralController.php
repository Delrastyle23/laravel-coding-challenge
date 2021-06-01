<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Mail\Referral as MailReferral;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    //
    public function index(){
        $referrals = Referral::where('user_id',Auth::id())->get(); 
        return view('referral.index', compact('referrals'));
    }

    public function store(Request $request){

        $emails = explode(",",$request->emails);
        
        for($i=0; $i < count($emails); $i++){
            $token = Str::uuid();
            $referral[] = [
                'user_id' => Auth::id(),
                'email' => $emails[$i],
                'token' => $token,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            //send email

            Mail::to($emails[$i])->send(new MailReferral($emails[$i], $token));

        }
        
        Referral::insert($referral);
        

        return redirect("/referral")->with([
            'alert.context' => 'success',
            'alert.message' => "You successfully send a referral/s."
        ]);
    }

    public function edit($token){

        // $referral = Referral::where('token', $token)->first();

        // $referral->status = 1;
        // $referral->save();
        // dd($token);

        return view('referral.form')->with([$token]);
    }
}
