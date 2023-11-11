<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:200',
            'email' => 'required|email|string|min:5|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:200|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->first());
        }

        $validated = $validator->validated();

        $user = User::create($validated);

        Event::dispatch(new Registered($user));

        return redirect('/')->with('message', 'Verification message send on your email!');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:200',
            'password' => 'required|string|max:200'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->first());
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors("Wrong credentials");
        }

        $user = User::where('email', $credentials['email'])->first();
        Auth::login($user);
        return view('user');
    }
}
