<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\HasApiResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest as Login;
use App\Http\Requests\RegistrationRequest as Register;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    use HasApiResponse;

    public function register(Register $request, User $user)
    {
        try {
            $user = $user->saveUser($request);
            return $this->httpCreated($user, "User created successfully");
        } catch (\Throwable $th) {
            Log::error('Registration failed :: ' . $th->getMessage());
            return $this->httpInternalServerError($th->getMessage());
        }
    }

    public function login(Login $request)
    {   
        if (Auth::guard('web')->attempt($request->validated())) {
            $user = Auth::guard('web')
                        ->user()
                        ->generateAndSaveApiAuthToken();

            return $this->httpSuccess('User is logged in!',$user);
        }

        return $this->httpUnauthorizedError('Email or password not matched! try again!');
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return $this->httpSuccess('User is logged out!',$user);
    }

    public function customerLogin(Login $request)
    {  
        if (Auth::guard('customer')->attempt($request->validated())) {
            $user = Auth::guard('customer')
                        ->user()
                        ->generateAndSaveApiAuthToken();

            return $this->httpSuccess('Customer is logged in!',$user);
        }

        return $this->httpUnauthorizedError('Email or password not matched! try again!');
    }

    public function customerLogout()
    {
        $customer = Auth::guard('customer-api')->user();

        if ( $customer ) {
            $customer->api_token = null;
            $customer->save();
        }

        return $this->httpSuccess('User is logged out!',$customer);
    }
}
