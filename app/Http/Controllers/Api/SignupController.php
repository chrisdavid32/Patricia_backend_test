<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    // USER SIGNUP
    /**
     * Create new user
     * @return json
     */
    public function create(SignupRequest $request)
    {
        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'password']);
        $data['password'] = Hash::make('password');

        // Try user save or catch error if any
        try{
            User::create($data);
            
            //call created response from default Controller
            return $this->created("Registered Successfully");

        } catch (\Exception $e) {
            return $this->severerror($e->getMessage());
        }
    }
}
