<?php

namespace App\Livewire\Tps;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class TpsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $kabupaten, $kecamatan, $kelurahan, $selectedId, $jumlah_dpt, $jumlah_surat_suara, $jml_surat_suara_sah, $jml_surat_suara_tidak_sah, $nama_tps;

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

        $tps = Tps::findOrFail($id);
        $this->selectedId = $tps->id;
        $this->nama_tps = $tps->nama_tps;
        $this->kelurahan = $tps->kelurahan->nama_kelurahan;
        $this->kecamatan = $tps->kelurahan->kecamatan->nama_kecamatan;
        $this->kabupaten = $tps->kelurahan->kecamatan->kabupaten->nama_kabupaten;
        $this->jumlah_dpt = $tps->jumlah_dpt;
        $this->jumlah_surat_suara = $tps->jumlah_surat_suara;
        $this->jml_surat_suara_sah = $tps->jml_surat_suara_sah;
        $this->jml_surat_suara_tidak_sah = $tps->jml_surat_suara_tidak_sah;

    }

    public function update()
    {

        $this->validate([
            'jumlah_surat_suara' => 'nullable|integer',
            'jumlah_dpt' => 'nullable|integer',
            'jml_surat_suara_sah' => 'nullable|integer',
            'jml_surat_suara_tidak_sah' => 'nullable|integer',
        ], [
            'jumlah_surat_suara.integer' => 'Jumlah surat suara harus berupa angka.',
            'jumlah_dpt.integer' => 'Jumlah DPT harus berupa angka.',
            'jml_surat_suara_sah.integer' => 'Jumlah surat suara sah harus berupa angka.',
            'jml_surat_suara_tidak_sah.integer' => 'Jumlah surat suara tidak sah harus berupa angka.',
        ]);

        $tps = Tps::findOrFail($this->selectedId);
        $tps->update([
            'jumlah_surat_suara' => $this->jumlah_surat_suara ?? 0,
            'jumlah_dpt' => $this->jumlah_dpt ?? 0,
            'jml_surat_suara_sah' => $this->jml_surat_suara_sah ?? 0,
            'jml_surat_suara_tidak_sah' => $this->jml_surat_suara_tidak_sah ?? 0,
        ]);

        session()->flash('success', 'Data TPS Berhasil Diubah.');

    }

    public function hapus()
    {
        Tps::findOrFail($this->selectedId)->delete();
        session()->flash('success', 'Data TPS Berhasil Dihapus.');
        $this->resetInputFields();
    }


    private function resetInputFields()
    {
        $this->jumlah_surat_suara = '';
        $this->jumlah_dpt = '';
        $this->jml_surat_suara_sah = '';
        $this->jml_surat_suara_tidak_sah = '';
        $this->selectedId = '';
    }

    public function render()
    {
        $query = Tps::with(['kelurahan', 'kecamatan', 'kabupaten']);

        if ($this->search !== null) {
            // Pencarian di nama_tps
            $query->where('nama_tps', 'like', '%' . $this->search . '%')
                // Tambahkan pencarian pada kelurahan
                ->orWhereHas('kelurahan', function ($q) {
                    $q->where('nama_kelurahan', 'like', '%' . $this->search . '%');
                })
                // Tambahkan pencarian pada kecamatan
                ->orWhereHas('kecamatan', function ($q) {
                    $q->where('nama_kecamatan', 'like', '%' . $this->search . '%');
                })
                // Tambahkan pencarian pada kabupaten
                ->orWhereHas('kabupaten', function ($q) {
                    $q->where('nama_kabupaten', 'like', '%' . $this->search . '%');
                });


        }

        $tps = $query->latest()->paginate(10);

        return view('livewire.tps.tps-list', compact(['tps']));
    }
}
