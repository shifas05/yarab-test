<?php

namespace App\Http\Controllers\User\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'phone_number' => $request->phone_number
        ];

        User::query()->create($data);

        return response()->json([
           'message' => 'User created successfully'
        ]);
    }
}
