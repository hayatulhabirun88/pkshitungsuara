<?php

namespace App\Livewire\Pengguna;

use App\Models\User;
use App\Models\Saksi;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class PenggunaShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $username, $email, $password, $confirm_password, $level, $selectedId;
    public $isOpen = false;
    public $isOpenDelete = false;

    protected $updatesQueryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->isOpen = false;
        $this->resetPage();
    }

    public function tambah()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->selectedId = null;

    }

    public function save()
    {
        $this->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:password',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa teks.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang valid.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',

            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',

            'confirm_password.required' => 'Konfirmasi kata sandi harus diisi.',
            'confirm_password.string' => 'Konfirmasi kata sandi harus berupa teks.',
            'confirm_password.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi.',
        ]);

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'level' => $this->level,
        ]);

        session()->flash('success', 'Data User ' . $this->username . '  Berhasil Ditambahkan.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenDelete = false;

        $user = User::findOrFail($id);
        $this->selectedId = $user->id;
        $this->level = $user->level;
        $this->username = $user->username;
        $this->email = $user->email;

    }

    public function update()
    {
        $user = User::findOrFail($this->selectedId);

        $this->validate([
            'username' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|string|same:password',
            'level' => 'nullable|string',

        ], [
            'username.string' => 'Username harus berupa teks.',
            'email.email' => 'Email harus dalam format yang valid.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
            'confirm_password.string' => 'Konfirmasi kata sandi harus berupa teks.',
            'confirm_password.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi.',
        ]);

        $user->username = $this->username;
        $user->email = $this->email;
        $user->level = $this->level;

        if ($this->password !== null) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        session()->flash('success', 'Data Pengguna  ' . $this->username . '  Berhasil Diubah.');


    }

    public function deleteshow($id)
    {
        $this->isOpenDelete = true;
        $this->isOpen = false;
        $this->selectedId = $id;
        $user = User::findOrFail($id);
        $this->username = $user->username;
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);

        Saksi::where('user_id', $user->id)->delete();
        $user->delete();

        session()->flash('deletesuccess', 'Data User berhasil dihapus!');
        $this->isOpenDelete = false;
    }

    private function resetInputFields()
    {
        $this->username = '';
        $this->level = '';
        $this->password = '';
        $this->email = '';
        $this->confirm_password = '';
        $this->selectedId = '';
    }
    public function render()
    {
        $query = User::query();

        if ($this->search !== null) {
            $query->where('username', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $user = $query->latest()->paginate(10);
        return view('livewire.pengguna.pengguna-show', compact(['user']));
    }
}
