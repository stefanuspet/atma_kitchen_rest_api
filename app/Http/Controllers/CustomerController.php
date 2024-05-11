<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;

class CustomerController extends Controller
{
    public function getProfile()
    {
        $customer = Auth::user();
        if (!$customer) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }
        return response()->json([
            "customer" => $customer
        ]);
    }

    // forget password
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $customer = Customer::where('email_customer', $request->email)->first();

        if (!$customer) {
            return response()->json([
                'message' => 'Email not found'
            ], 404);
        }

        $str = Str::random(20);
        PasswordReset::create([
            'email' => $request->email,
            'token' => $str,
            'is_used' => false
        ]);

        $details = [
            'username' => $customer->nama_customer,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            // 'url' => request()->getHttpHost() . '/customers/verify/' . $str
            'url' =>  'localhost:5173/customers/verify/' . $str
        ];

        Mail::to($request->email)->send(new Email($details));

        return response()->json([
            'message' => 'Check your email to reset password'
        ], 200);
    }

    public function verify(Request $request, $token)
    {
        $tokenCheck = PasswordReset::where('token', $token)
            ->where('is_used', false)
            ->exists();

        if (!$tokenCheck) {
            return response()->json([
                'message' => 'Token not valid'
            ], 404);
        }

        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $passwordReset = PasswordReset::where('token', $token)
            ->where('is_used', false)
            ->first();

        $customer = Customer::where('email_customer', $passwordReset->email)->first();
        $customer->update([
            'password_customer' => Hash::make($request->password)
        ]);

        $passwordReset->delete();

        return response()->json([
            'message' => 'Password updated'
        ], 200);
    }
}
