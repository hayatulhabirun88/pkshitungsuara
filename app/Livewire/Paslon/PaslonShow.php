<?php

namespace App\Livewire\Paslon;

use App\Models\Paslon;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PaslonShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $nama_paslon, $no_urut, $foto, $wilayah, $selectedId;
    public $listWilayah = [];
    public $isOpen = false;
    public $isOpenDelete = false;

    public function tambah()
    {
        $this->reset(['nama_paslon', 'no_urut', 'foto', 'wilayah']);
        $this->isOpen = true;
        $this->selectedId = null;

    }

    public function save()
    {
        $this->validate([
            'nama_paslon' => 'required|string',
            'no_urut' => 'required|integer',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
            'wilayah' => 'required|string',
        ], [
            'nama_paslon.required' => 'Nama pasangan calon harus diisi.',
            'nama_paslon.string' => 'Nama pasangan calon harus berupa teks.',
            'no_urut.required' => 'Nomor urut harus diisi.',
            'no_urut.integer' => 'Nomor urut harus berupa angka.',
            'foto.required' => 'Foto harus diunggah.',
            'wilayah.required' => 'Wilayah harus diisi.',
            'wilayah.string' => 'Wilayah harus berupa teks.',
        ]);


        $fileName = 'foto_paslon_' . time() . '.' . $this->foto->getClientOriginalExtension();

        $this->foto->storeAs('foto_paslon', $fileName, 'public');


        Paslon::create([
            'nama_paslon' => $this->nama_paslon,
            'no_urut' => $this->no_urut,
            'foto' => $fileName,
            'wilayah_id' => $this->wilayah,
        ]);

        session()->flash('success', 'Data Paslon ' . $this->nama_paslon . '  Berhasil Ditambahkan.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenDelete = false;

        $paslon = Paslon::findOrFail($id);
        $this->selectedId = $paslon->id;
        $this->nama_paslon = $paslon->nama_paslon;
        $this->no_urut = $paslon->no_urut;
        $this->wilayah = $paslon->wilayah_id;
        $this->foto = $paslon->foto;

    }

    public function update()
    {

        $paslon = Paslon::findOrFail($this->selectedId);

        $this->validate([
            'nama_paslon' => 'required|string',
            'no_urut' => 'required|integer',
            'wilayah' => 'required|string',

        ], [
            'nama_paslon.required' => 'Nama pasangan calon harus diisi.',
            'nama_paslon.string' => 'Nama pasangan calon harus berupa teks.',
            'no_urut.required' => 'Nomor urut harus diisi.',
            'no_urut.integer' => 'Nomor urut harus berupa angka.',

            'wilayah.required' => 'Wilayah harus diisi.',
            'wilayah.string' => 'Wilayah harus berupa teks.',
        ]);


        if ($this->foto != $paslon->foto) {
            $this->validate([
                'foto' => 'nullable|image|mimes:jpg,png,jpeg',
            ], [
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berekstensi jpg, png, jpeg.',
            ]);

            @unlink(public_path('storage/foto_paslon/' . $paslon->foto));
            $fileName = 'foto_paslon_' . time() . '.' . $this->foto->getClientOriginalExtension();
            $this->foto->storeAs('foto_paslon', $fileName, 'public');
            $paslon->foto = $fileName;
        }

        $paslon->nama_paslon = $this->nama_paslon;
        $paslon->no_urut = $this->no_urut;
        $paslon->wilayah_id = $this->wilayah;
        $paslon->save();

        session()->flash('success', 'Data Paslon ' . $this->nama_paslon . '  Berhasil Diubah.');


    }

    public function deleteshow($id)
    {
        $this->isOpenDelete = true;
        $this->isOpen = false;
        $this->selectedId = $id;
        $paslon = Paslon::findOrFail($id);
        $this->nama_paslon = $paslon->nama_paslon;
    }


    public function delete($id)
    {
        $paslon = Paslon::findOrFail($id);
        @unlink(public_path('storage/foto_paslon/' . $paslon->foto));
        $paslon->delete();
        session()->flash('deletesuccess', 'Data Paslon berhasil dihapus!');
        $this->isOpenDelete = false;
    }

    private function resetInputFields()
    {
        $this->nama_paslon = '';
        $this->no_urut = '';
        $this->foto = '';
        $this->wilayah = '';
        $this->selectedId = '';
    }

    public function mount()
    {
        $this->getListWilayah();
    }

    public function getListWilayah()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', asset('/') . 'api-wilayah-indonesia/static/api/regencies/74.json');

            // Mengambil data response
            $data = json_decode($response->getBody()->getContents(), true);

            // Menyimpan data ke variabel
            $this->listWilayah = $data;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function render()
    {
        $paslon = Paslon::latest()->paginate(10);
        return view('livewire.paslon.paslon-show', compact(['paslon']));
    }
}
