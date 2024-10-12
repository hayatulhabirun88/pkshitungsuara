<?php

namespace App\Livewire\Mobile;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    public function proses_login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:5'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa string.',
            'password.min' => 'Kata sandi minimal harus terdiri dari 8 karakter.',
        ]);

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only(['email', 'password']))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);


        }

        RateLimiter::clear($this->throttleKey());


        // Check if the authenticated user is an 'admin'
        if (auth()->user()->level != 'saksi') {
            Auth::logout(); // Log out the user if not admin
            // Flash an error message to the session
            session()->flash('error', 'Tidak diperbolehkan login sebagai admin.');

            // Redirect back to the login page
            return redirect()->route('mobile.login');
        } else {
            if (auth()->user()->saksi->status == 'Tidak Aktif') {
                Auth::logout(); // Log out the user if not admin
                // Flash an error message to the session
                session()->flash('error', 'Status login anda belum aktif, silahkan hubungi admin');

                // Redirect back to the login page
                return redirect()->route('mobile.login');
            } elseif (auth()->user()->saksi->tps_id === NULL || auth()->user()->saksi->tps_id === "") {
                Auth::logout(); // Log out the user if not admin
                // Flash an error message to the session
                session()->flash('error', 'Lokasi TPS blm di SET, silahkan hubungi admin.');

                // Redirect back to the login page
                return redirect()->route('mobile.login');
            }

            return redirect()->route('mobile.dashboard');
        }


    }


    public function render()
    {
        return view('livewire.mobile.login');
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
