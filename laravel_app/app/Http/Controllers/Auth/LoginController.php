<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
{
    $userEmail = auth()->user()->email;
    $adminEmail = env('ADMIN_EMAIL');

    
    if ($userEmail === $adminEmail) {
        return '/home';
    }

    // Svi ostali idu na listu vozila
    return '/vehicle';
}
}
