<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Rules\Reserved;

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
            'username' => ['required', 'string', 'alpha_num', 'min:3', 'max:255', 'unique:users', new Reserved],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'stream_key' => $this->createKey(),
            'password' => Hash::make($input['password']),
        ]);
    }

    protected function createKey()
    {
        while(true){
            $key = \Str::random(40);
            $existingKey = User::where('stream_key', $key)->first();

            if(!$existingKey){
                return $key;
            }
        }
    }
}
