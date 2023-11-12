<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class EmailController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($request->id);
        $request['hash'] = $hash;

        if (!hash_equals(
            (string) $request->route('id'),
            (string) $user->getKey()
        )) {
            throw new AuthorizationException();
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->email_verified_at) {
            return redirect('verify_success');
        }

        if ($user->markEmailAsVerified()) {
            Event::dispatch(new Verified($user));
        }

        return redirect('/email/verify/success');
    }

    public function notVerified()
    {
        Auth::logout();
        return redirect('/')->with('message', 'You not verified!');
    }
}
