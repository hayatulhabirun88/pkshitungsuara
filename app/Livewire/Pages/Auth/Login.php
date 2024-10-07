<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];


    protected $messages = [
        'email.required' => 'Email harus diisi',
        'email.email' => 'Masukan email yang valid',
        'password.required' => 'Password harus diisi',
    ];

    public function login()
    {

        $key = 'login_attempts:' . request()->ip();

        $limiter = app('Illuminate\Cache\RateLimiter');

        if ($limiter->tooManyAttempts($key, 10)) {
            throw ValidationException::withMessages([
                'email' => ['Terlalu banyak percobaan login. Coba lagi nanti.'],
            ]);
        }

        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $limiter->clear($key);
            session()->regenerate();
            return redirect()->intended('dashboard');
        }


        $limiter->hit($key, 60);

        throw ValidationException::withMessages([
            'email' => ['Email atau password salah.'],
        ]);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
