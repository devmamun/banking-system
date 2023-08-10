<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Store
     *
     * @param array $data
     * @return bool
     */
    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::insert($data);
    }

    /**
     * User Authenticate
     *
     * @param array $data
     * @return bool
     */
    public function authenticate($data)
    {
        $userData = User::where(['email' => $data['email'], 'account_type' => $data['account_type']])->first();

        if (!$userData) {
            return redirect()->back()->withErrors('Email does not match with this account type.');
        }

        if (Hash::check($data['password'], $userData->password)) {
            unset($data['account_type']);

            if (Auth::attempt($data)) {
                return true;
            }

            return back()->withInput()->withErrors(['error' => __("Invalid User")]);
        } else {
            return back()->withInput()->withErrors(['email' => __("Invalid password")]);
        }
    }
}
