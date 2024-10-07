<?php

namespace App\Livewire\Tps;

use App\Models\Tps;
use Livewire\Component;
use App\Models\Kabupaten;
use App\Models\Kelurahan;
use Livewire\WithPagination;

class TpsShow extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $kabupaten_id, $kecamatan_id, $kelurahan_id, $selectedId, $kelurahan, $kecamatan, $kabupaten, $jumlah_tps;

    public $listKabupaten = [];

    protected $updatesQueryString = ['search'];
    public $search = '';

    public $isOpen = false;

    public function updatingSearch()
    {
        $this->isOpen = false;
        $this->resetPage();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->isOpen = true;

        $kelurahan = Kelurahan::findOrFail($id);
        $this->kelurahan_id = $kelurahan->id;
        $this->kelurahan = $kelurahan->nama_kelurahan;
        $this->kecamatan = $kelurahan->kecamatan->nama_kecamatan;
        $this->kabupaten = $kelurahan->kecamatan->kabupaten->nama_kabupaten;

    }

    public function update()
    {

        $this->validate([
            'jumlah_tps' => 'required|integer',
        ], [
            'jumlah_tps.required' => 'Jumlah TPS harus diisi.',
            'jumlah_tps.integer' => 'Jumlah TPS harus berupa angka yang valid.',
            'kelurahan_id.required' => 'Kelurahan harus dipilih.',
            'kelurahan_id.integer' => 'Kelurahan harus berupa angka yang valid.',
        ]);

        $kelurahan = Kelurahan::findOrFail($this->kelurahan_id);
        Tps::where('kelurahan_id', $this->kelurahan_id)->delete();

        for ($i = 1; $i <= $this->jumlah_tps; $i++) {
            $tps = new Tps();
            $tps->nama_tps = 'TPS ' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $tps->kelurahan_id = $this->kelurahan_id;
            $tps->kecamatan_id = $kelurahan->kecamatan->id;
            $tps->kabupaten_id = $kelurahan->kecamatan->kabupaten->id;
            $tps->save();
        }

        session()->flash('success', 'Data Jumlah TPS Berhasil Diubah.');
        $this->resetInputFields();

    }

    public function hapus()
    {
        Tps::where('kelurahan_id', $this->kelurahan_id)->delete();
        session()->flash('success', 'Data TPS Berhasil Dihapus.');
        $this->resetInputFields();
    }


    private function resetInputFields()
    {
        $this->kelurahan_id = '';
        $this->kecamatan_id = '';
        $this->kabupaten_id = '';
        $this->jumlah_tps = '';
        $this->selectedId = '';
    }

    public function mount()
    {
        $this->listKabupaten = Kabupaten::where('status', 'Aktif')->first();
    }


    public function render()
    {
        $query = Kelurahan::query();

        if ($this->search !== null) {
            $query->where('nama_kelurahan', 'like', '%' . $this->search . '%');
        }

        $tps = $query->latest()->paginate(10);
        return view('livewire.tps.tps-show', compact(['tps']));
    }
}
