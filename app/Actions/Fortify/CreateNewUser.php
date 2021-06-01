<?php

namespace App\Actions\Fortify;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
      
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        
        
        if($input['token']){
        
            $refer = Referral::where('token', $input['token'])->first();
            if($refer){
                
                Validator::make($input, [
                    'email' => ['limit_referral:'.$refer->user_id],
                ])->validate();

                $referral = Referral::where('token', $input['token'])->where('email', $input['email'])->first();
                
                if($referral){
                    $referral->status = 1;
                    $referral->save();
                }
            }
            
            
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
