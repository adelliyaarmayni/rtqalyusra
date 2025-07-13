<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Arahkan berdasarkan role
        if ($user->hasRole('admin')) {
            $redirect = '/admin';
        } elseif ($user->hasRole('guru')) {
            $redirect = '/guru';
        } elseif ($user->hasRole('yayasan')) {
            $redirect = '/yayasan';
        } else {
            $redirect = '/';
        }

        return redirect()->intended($redirect);
    }
}
