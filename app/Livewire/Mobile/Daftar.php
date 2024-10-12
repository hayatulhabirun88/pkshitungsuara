<?php

namespace App\Livewire\Mobile;

use App\Models\User;
use App\Models\Saksi;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Daftar extends Component
{
    public $nama, $username, $alamat, $no_hp, $email, $password, $confirm_password;

    public function daftar()
    {
        $this->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'alamat' => 'required',
            'no_hp' => 'required|unique:saksis',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Kata sandi minimal harus terdiri dari 6 karakter.',
        ]);

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'level' => 'saksi',
        ]);

        Saksi::create([
            'nama_lengkap' => $this->nama,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'user_id' => $user->id,
            'tps_id' => null,
            'kode_register' => null,
            'status' => 'Tidak Aktif',
        ]);

        session()->flash('success', 'Pendaftaran Sukses, Silahkan hubungi admin untuk mengaktifkan akun!');
        // Redirect to the login page
        return redirect()->route('mobile.login');
    }
    public function render()
    {
        return view('livewire.mobile.daftar');
    }
}
