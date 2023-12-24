<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Employer;

use App\Models\Candidate;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {   

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string','max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : ''
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
            'role' => $input['user_role']
        ]) ;
        if($input['user_role'] == "job_seeker"){
            // Validator::make($input, [
            //     'age' => ['max:255'],
            //     'gender'=> ['string','max:255'],
            //     'jobPreferences' => ['string','max:255']
            // ])->validate();
            Candidate::create([
                'user_id' => $user->id,
                'age' => $input['age'],
                'gender' => $input['gender'],
                'jobPreferences' => $input['jobPreferences']
            ]);
        }else if($input['user_role'] == "employer"){
            // Validator::make($input, [
            //     'companyName'=> ['string','max:255'],
            //     'city'=> ['string','max:255'],
            //     'zip' => ['max:255'],
            //     'country'=> ['string','max:255'],
            //     'industry'=> ['string','max:255'],
            //     'employeeCount'=> ['max:255']
            // ])->validate();
            Employer::create([
                'user_id' => $user->id,
                'companyName' => $input['companyName'],
                'city' => $input['city'],
                'zip' => $input['zip'],
                'country' => $input['country'],
                'industry' => $input['industry'],
                'employeeCount' => $input['employeeCount']
            ]);
        }
        return $user;
    }
}