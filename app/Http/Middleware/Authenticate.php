<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        // Ternary operator -- $variable = (kondisi) ? nilai jika benar : nilai jika salah;
        // return $request->expectsJson() ? null : route('login');

        // Jika berhasil login, ngga langsung ke dashboard tapi diarahkan ke route index, kalo gagal login karena kita pake modal pop up, jadi redirectnya ke index juga
        return $request->expectsJson() ? null : route('index.landing');
    }
}
