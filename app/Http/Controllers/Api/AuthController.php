<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // USER LOGIN
    /**
     * login Registered user
     * @return json
     */
    public function login(LoginRequest $request)
    {
        //required login credential
        $credentials = $request->only(['email', 'password']);

        // Attempt login or catch error if any
        try {
            if (Auth::attempt($credentials)) {
                /** @var User $user */
                $user = Auth::User();
                $token = $user->createToken('User Access Token')->accessToken;

                //call Success response from default Controller
                return $this->success(['user' => $user, 'access_token' => $token, 'authorization' => 'Bearer']);
            } else {
                return $this->badrequest("Invalid login details");
            }
        } catch (\Exception $e) {
            return $this->severerror($e->getMessage());
        }
    }
}
