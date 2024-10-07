<?php

namespace App\Livewire\Saksi;

use App\Models\Tps;
use App\Models\User;
use App\Models\Saksi;
use Livewire\Component;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class SaksiShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama_saksi, $username, $kecamatan, $kelurahan, $tps, $email, $password, $confirm_password, $alamat, $no_hp, $status, $kode_register, $tps_id, $user_id, $selectedId;
    public $isOpen = false;
    public $isOpenDelete = false;

    public $listKabupaten = [];

    public $listKecamatan = [];
    public $listKelurahan = [];
    public $listTps = [];

    protected $updatesQueryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->isOpen = false;
        $this->resetPage();
    }

    public function updatedKecamatan()
    {

        $this->listKelurahan = Kelurahan::where('kecamatan_id', $this->kecamatan)->get();
    }

    public function updatedKelurahan()
    {
        $this->listTps = Tps::where('kelurahan_id', $this->kelurahan)->get();
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
            'nama_saksi' => 'required|string',
            'no_hp' => 'required|string|unique:saksis,no_hp',
            'status' => 'required|string',
            'alamat' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:password',
        ], [
            'nama_saksi.required' => 'Nama saksi harus diisi.',
            'nama_saksi.string' => 'Nama saksi harus berupa teks.',

            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.unique' => 'Nomor HP sudah terdaftar, gunakan nomor lain.',

            'status.required' => 'Status harus diisi.',
            'status.string' => 'Status harus berupa teks.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

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
            'level' => 'saksi',
        ]);

        Saksi::create([
            'nama_lengkap' => $this->nama_saksi,
            'no_hp' => $this->no_hp,
            'status' => $this->status,
            'alamat' => $this->alamat,
            'user_id' => $user->id,
            'tps_id' => null,
            'kode_register' => null,
        ]);

        session()->flash('success', 'Data Saksi ' . $this->nama_saksi . '  Berhasil Ditambahkan.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenDelete = false;

        $saksi = Saksi::findOrFail($id);
        $this->selectedId = $saksi->id;
        $this->nama_saksi = $saksi->nama_lengkap;
        $this->alamat = $saksi->alamat;
        $this->no_hp = $saksi->no_hp;
        $this->status = $saksi->status;
        $this->tps_id = $saksi->tps_id;
        $this->user_id = $saksi->user_id;

        $this->listKabupaten = Kabupaten::where('status', 'Aktif')->first();

        $this->listKecamatan = Kecamatan::where('kabupaten_id', $this->listKabupaten->id)->get();

    }

    public function update()
    {
        $saksi = Saksi::findOrFail($this->selectedId);

        $this->validate([
            'nama_saksi' => 'required|string',
            'no_hp' => 'required|string|unique:saksis,no_hp,' . $saksi->id,
            'status' => 'required|string',
            'alamat' => 'required|string',
        ], [
            'nama_saksi.required' => 'Nama saksi harus diisi.',
            'nama_saksi.string' => 'Nama saksi harus berupa teks.',

            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.unique' => 'Nomor HP sudah terdaftar, gunakan nomor lain.',

            'status.required' => 'Status harus diisi.',
            'status.string' => 'Status harus berupa teks.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa teks.',
        ]);


        $saksi->nama_lengkap = $this->nama_saksi;
        $saksi->no_hp = $this->no_hp;
        $saksi->status = $this->status;
        $saksi->alamat = $this->alamat;
        $saksi->save();

        session()->flash('success', 'Data Saksi ' . $this->nama_saksi . '  Berhasil Diubah.');


    }

    public function deleteshow($id)
    {
        $this->isOpenDelete = true;
        $this->isOpen = false;
        $this->selectedId = $id;
        $saksi = Saksi::findOrFail($id);
        $this->nama_saksi = $saksi->nama_lengkap;
    }


    public function delete($id)
    {
        $saksi = Saksi::findOrFail($id);
        $saksi->delete();
        User::findOrFail($saksi->user_id)->delete();
        session()->flash('deletesuccess', 'Data Saksi berhasil dihapus!');
        $this->isOpenDelete = false;
    }

    private function resetInputFields()
    {
        $this->nama_saksi = '';
        $this->alamat = '';
        $this->no_hp = '';
        $this->status = '';
        $this->tps_id = '';
        $this->user_id = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->selectedId = '';
    }

    public function render()
    {
        $query = Saksi::query();

        if ($this->search !== null) {
            $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('no_hp', 'like', '%' . $this->search . '%')
                ->orWhere('alamat', 'like', '%' . $this->search . '%');
        }

        $saksi = $query->latest()->paginate(10);

        return view('livewire.saksi.saksi-show', compact(['saksi']));
    }
}
