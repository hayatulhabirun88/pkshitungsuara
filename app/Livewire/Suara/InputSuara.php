<?php

namespace App\Livewire\Suara;

use App\Models\Tps;
use App\Models\Suara;
use App\Models\Paslon;
use Livewire\Component;
use App\Models\Kabupaten;
use App\Models\Kelurahan;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class InputSuara extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $kabupaten_id, $kecamatan_id, $kelurahan_id, $selectedId, $kelurahan, $kecamatan, $kabupaten, $jumlah_surat_suara, $jml_surat_suara_sah, $jml_surat_suara_tidak_sah, $nama_tps, $nama_kelurahan, $nama_kecamatan, $nama_kabupaten, $bukti;

    public $listKabupaten = [];

    public $listPaslon = [];

    public $jumlah_suara = [];

    public $closeModalTps = false;

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
        $this->reset('jumlah_suara');
        $this->isOpen = true;

        $this->selectedId = $id;
        $tps = Tps::findOrFail($id);
        $this->listPaslon = Paslon::all();
        $suara = Suara::where('tps_id', $id)->get();
        $this->nama_tps = $tps->nama_tps;
        $this->nama_kelurahan = $tps->kelurahan->nama_kelurahan;
        $this->nama_kecamatan = $tps->kecamatan->nama_kecamatan;
        $this->nama_kabupaten = $tps->kabupaten->nama_kabupaten;

        foreach ($suara as $key => $value) {
            $this->jumlah_suara[$value->paslon_id] = $value->jumlah_suara;
        }
        $this->jumlah_surat_suara = $tps->jumlah_surat_suara;
        $this->jml_surat_suara_sah = $tps->jml_surat_suara_sah;
        $this->jml_surat_suara_tidak_sah = $tps->jml_surat_suara_tidak_sah;

    }

    public function update()
    {
        $this->validate([
            'jumlah_surat_suara' => 'required|numeric',
            'jml_surat_suara_sah' => 'required|numeric',
            'jml_surat_suara_tidak_sah' => 'required|numeric',
            'jumlah_suara.*' => 'required|numeric',
        ], [
            'jumlah_surat_suara.required' => 'Jumlah surat suara harus diisi.',
            'jumlah_surat_suara.numeric' => 'Jumlah surat suara harus berupa angka.',
            'jml_surat_suara_sah.required' => 'Jumlah surat suara sah harus diisi.',
            'jml_surat_suara_sah.numeric' => 'Jumlah surat suara sah harus berupa angka.',
            'jml_surat_suara_tidak_sah.required' => 'Jumlah surat suara tidak sah harus diisi.',
            'jml_surat_suara_tidak_sah.numeric' => 'Jumlah surat suara tidak sah harus berupa angka.',
            'jumlah_suara.*.required' => 'Jumlah suara harus diisi.',
            'jumlah_suara.*.numeric' => 'Jumlah suara harus berupa angka.',
        ]);

        foreach ($this->jumlah_suara as $key => $value) {
            $jmlSuara = preg_replace("/[^0-9]/", "", $value);
            Suara::updateOrCreate([
                'saksi_id' => auth()->user()->level == 'saksi' ? auth()->user()->id : null,
                'paslon_id' => $key,
                'tps_id' => $this->selectedId,
            ], [
                'jumlah_suara' => $jmlSuara === "" ? 0 : $jmlSuara,
            ]);
        }

        $tps = Tps::find($this->selectedId);

        $tps->jumlah_surat_suara = $this->jumlah_surat_suara;
        $tps->jml_surat_suara_sah = $this->jml_surat_suara_sah;
        $tps->jml_surat_suara_tidak_sah = $this->jml_surat_suara_tidak_sah;

        if ($this->bukti) {
            $this->validate([
                'bukti' => 'image|mimes:jpeg,png,jpg',
            ]);

            @unlink(public_path('storage/bukti/' . $tps->bukti));

            $fileName = time() . '-' . $this->bukti->getClientOriginalName();
            $this->bukti->storeAs('bukti', $fileName, 'public');
            $tps->bukti = $fileName;
        }

        $tps->save();

        session()->flash('success', 'Data Suara Berhasil Diubah.');
        $this->isOpen = false;
        $this->closeModalTps = true;

    }

    public function hapus()
    {
        Tps::where('kelurahan_id', $this->kelurahan_id)->delete();
        session()->flash('success', 'Data TPS Berhasil Dihapus.');
        $this->resetInputFields();
    }


    private function resetInputFields()
    {
        $this->jumlah_surat_suara = "";
        $this->jml_surat_suara_sah = "";
        $this->jml_surat_suara_tidak_sah = "";
    }

    public function mount()
    {
        $this->listKabupaten = Kabupaten::where('status', 'Aktif')->first();

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
        return view('livewire.suara.input-suara', compact(['tps']));
    }
}
