<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Session;

class AuthController extends Controller
{
    public function registerCustomer(Request $request)
    {
        try {
            $request->validate([
                'nama_customer' => 'required|max:100',
                'email_customer' => 'required|email|max:100|unique:customers',
                'password_customer' => ['required', 'max:100', Password::min(8)],
                'notelp_customer' => 'required|digits_between:11,14',
            ]);

            $str = Str::random(100);
            $customer = Customer::create([
                'nama_customer' => $request->nama_customer,
                'email_customer' => $request->email_customer,
                'password_customer' => Hash::make($request->password_customer),
                'notelp_customer' => $request->notelp_customer,
            ]);

            $details = [
                'username' => $customer->nama_customer,
                'website' => 'Atma Kitchen',
                'datetime' => date('Y-m-d H:i:s'),
                'url' => request()->getHttpHost() . '/api/customers/verify/' . $str
            ];

            // Mail::to($request->email)->send(new Email($details));

            // Session::flash('message', 'Link verifikasi telah dikirim ke email anda. Silahkan cek email anda untuk mengaktifkan akun.');

            return response()->json([
                'customer' => $customer,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => "Validation errors were encountered in the input.",
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }

    public function loginCustomer(Request $request)
    {

        $request->validate([
            'email_customer' => 'required',
            'password_customer' => 'required'
        ]);

        $customer = Customer::where('email_customer', $request->email_customer)->first();

        if (!$customer || !Hash::check($request->password_customer, $customer->password_customer)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'Email or Password invalid'
            ], 401);
        }


        $token = $customer->createToken("Customer Login")->plainTextToken;
        return response()->json([
            'message' => 'Login Success',
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout...'
        ], 200);
    }


    public function loginUser(Request $request)
    {
        $request->validate([
            'email_user' => 'required',
            'password_user' => 'required'
        ]);

        $user = User::where('email_user', $request->email_user)->first();

        if (!$user || !Hash::check($request->password_user, $user->password_user)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'Email or Password invalid'
            ], 401);
        }

        if ($user->id_jabatan == 1) {
            $token = $user->createToken("User Login", ['ADMIN'])->plainTextToken;
        } elseif ($user->id_jabatan == 2) {
            $token = $user->createToken("User Login", ['MO'])->plainTextToken;
        } else {
            $token = $user->createToken("User Login", ['OWNER'])->plainTextToken;
        }

        return response()->json([
            'message' => 'Login Success',
            'token' => $token
        ], 200);
    }

    public function testing(Request $request)
    {
        $customer = Customer::where('email_customer', $request->email)->first();
        $str = Str::random(100);
        $details = [
            'username' => $customer->nama_customer,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/reset/verify/' . $str
        ];
        Mail::to($request->email)->send(new Email($details));

        return response()->json([
            'message' => 'Email sent'
        ], 200);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email_user', $request->email)->first();
        $customer = Customer::where('email_customer', $request->email)->first();

        if (!$user && !$customer) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'Email or Password invalid'
            ], 401);
        }

        if ($user && !Hash::check($request->password, $user->password_user)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'Email or Password invalid'
            ], 401);
        }

        if ($customer && !Hash::check($request->password, $customer->password_customer)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'Email or Password invalid'
            ], 401);
        }

        $token = null;

        if ($user) {
            if ($user->id_jabatan == 1) {
                $token = $user->createToken("User Login", ['ADMIN'])->plainTextToken;
                $abilities = 'ADMIN';
            } elseif ($user->id_jabatan == 2) {
                $token = $user->createToken("User Login", ['MO'])->plainTextToken;
                $abilities = 'MO';
            } else {
                $token = $user->createToken("User Login", ['OWNER'])->plainTextToken;
                $abilities = 'OWNER';
            }
        } elseif ($customer) {
            $token = $customer->createToken("Customer Login", ['Customer'])->plainTextToken;
            $abilities = 'Customer';
        }

        return response()->json([
            'message' => 'Login Success',
            'token' => $token,
            'abilities' => $abilities
        ], 200);
    }
}
