<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\search;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }
        return response()->json([
            "user" => $user
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                "message" => "Email not found"
            ], 404);
        }
        $user->update([
            'password_user' => Hash::make($request->password_user)
        ]);
        return response()->json([
            "message" => "Password updated"
        ]);
    }

    // reset password
    public function resetPassword(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }
        $userid = $user->id;
        $userid->update([
            'password_user' => Hash::make($request->password_user)
        ]);
        return response()->json([
            "message" => "Password updated"
        ]);
    }
}
