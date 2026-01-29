<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Auth;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Kirim pesan sukses pendaftaran
        session()->flash('success', 'Registrasi Berhasil.');

        Auth::logout();

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil!');
    }
}
