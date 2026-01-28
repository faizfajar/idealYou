<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Kirim pesan sukses pendaftaran
        session()->flash('success', 'Registrasi Berhasil.');

        // Redirect ke halaman home/dashboard setelah register
        return $request->wantsJson()
            ? response()->json(['redirect' => Fortify::redirects('register')])
            : redirect()->intended(Fortify::redirects('register'));
    }
}