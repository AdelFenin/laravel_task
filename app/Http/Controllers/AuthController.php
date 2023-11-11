<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

            User::create($validated);
            
            return redirect('/')->with('message', 'State saved correctly!');
    }
}
