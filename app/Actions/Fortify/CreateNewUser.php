<?php

namespace App\Actions\Fortify;

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
            'zipcode' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'prefecture' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'],
            'birth' => ['nullable', 'date', 'before:yesterday'],
            'sex' => ['nullable', 'integer']
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'zipcode' => $input['zipcode'],
            'prefecture' => $input['prefecture'],
            'city' => $input['city'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birth' => $input['birth'],
            'sex' => $input['sex']
        ]);
    }
}
