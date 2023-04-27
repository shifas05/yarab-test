<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(UserProfileRequest $request)
    {
        $data = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob
        ];

        User::query()->update($data);

        return response()->json([
           'message' => 'Profile updated successfully'
        ]);
    }
}
