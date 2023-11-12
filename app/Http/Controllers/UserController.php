<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function MyInfoEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:200',
        ]);

        if ($validator->fails()) {
            return back()->with('message', $validator->errors()->first());
        }

        $validated = $validator->validated();

        User::where('id', auth()->id())->update($validated);

        return redirect('/user')->with('message', 'Updated successfully!');
    }

    public function MyPasswordEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:200',
            'password_new' => 'required|string|min:6|max:200|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->with('message', $validator->errors()->first());
        }

        $validated = $validator->validated();

        if(!Hash::check($validated['password'], auth()->user()->password)){
            return back()->with('message', "Old Password Doesn't match");
        }

        if($validated['password'] === $validated['password_new']){
            return back()->with('message', "Passwords is equal");
        }

        User::where('id', auth()->id())->update([
            'password' => bcrypt($validated['password_new']),
        ]);

        return redirect('/user')->with('message', 'Updated successfully!');
    }
}
