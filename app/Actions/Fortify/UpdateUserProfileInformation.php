<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'zipcode' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'prefecture' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'],
            'birth' => ['nullable', 'date', 'before:yesterday'],
            'sex' => ['nullable', 'integer']
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'email_verified_at' => null,
                'zipcode' => $input['zipcode'],
                'prefecture' => $input['prefecture'],
                'city' => $input['city'],
                'address' => $input['address'],
                'phone' => $input['phone']
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'zipcode' => $input['zipcode'],
            'prefecture' => $input['prefecture'],
            'city' => $input['city'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birth' => $input['birth'],
            'sex' => $input['sex']
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
