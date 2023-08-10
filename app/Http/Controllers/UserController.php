<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Registration form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registration()
    {
        return view('authentication.registration');
    }

    /**
     * User Store
     *
     * @param StoreUserRequest $request
     * @param UserService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request, UserService $service)
    {
        if ($service->store($request->validated())) {
            return redirect()->route('login');
        }
    }
    /**
     * User Login Form
     *
     * @return Illuminate\Contracts\View\View
     */
    public function login()
    {
       return view('authentication.login');
    }
    /**
     * User Store
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\
     */
    public function authenticate(AuthenticateUserRequest $request, UserService $service)
    {
        if ($service->authenticate($request->validated())) {
            return redirect()->route('user.transaction');
        }
    }
}
