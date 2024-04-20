<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PasswordReset;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
        try {
            $request->validate([
                'email_customer' => 'required|email'
            ]);

            $customer = Customer::where('email_customer', $request->email_customer)->first();
            if (!$customer) {
                return response()->json([
                    "message" => "Email not found"
                ], 404);
            }

            $token = bin2hex(random_bytes(32));
            $domain = env('APP_URL');
            $url = "{$domain}/reset-password?token={$token}";

            $data['url'] = $url;
            $data['email_customer'] = $request->email;
            $data['title'] = "Password Reset";
            $data['content'] = "Click the button below to reset your password";
            $data['button'] = "Reset Password";

            Mail::send('forgetPasswordEmail', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email_customer']);
                $message->subject($data['title']);
            });

            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            PasswordReset::updateOrCreate(
                ["email_customer" => $request->email],
                [
                    "email_customer" => $request->email,
                    "token" => $token,
                    "created_at" => $datetime
                ]
            );

            return response()->json([
                "message" => "Email sent"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
