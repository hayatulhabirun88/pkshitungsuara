<?php

namespace App\Livewire\Mobile;

use App\Models\Tps;
use App\Models\Suara;
use App\Models\Paslon;
use Livewire\Component;
use Livewire\WithFileUploads;

class InputSuara extends Component
{
    use WithFileUploads;
    public $jumlah_surat_suara, $jml_surat_suara_sah, $jml_surat_suara_tidak_sah, $bukti;


    public $jumlah_suara = [];

    public function simpan()
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
                'tps_id' => auth()->user()->saksi->tps_id,
            ], [
                'jumlah_suara' => $jmlSuara === "" ? 0 : $jmlSuara,
            ]);
        }

        $tps = Tps::find(auth()->user()->saksi->tps_id);

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

    }

    public function mount()
    {
        $suara = Suara::where('tps_id', auth()->user()->saksi->tps_id)->get();

        foreach ($suara as $key => $value) {
            $this->jumlah_suara[$value->paslon_id] = $value->jumlah_suara;
        }

        $tps = Tps::find(auth()->user()->saksi->tps_id);
        $this->jumlah_surat_suara = $tps->jumlah_surat_suara ?? 0;
        $this->jml_surat_suara_sah = $tps->jml_surat_suara_sah ?? 0;
        $this->jml_surat_suara_tidak_sah = $tps->jml_surat_suara_tidak_sah ?? 0;

    }


    public function render()
    {
        $listPaslon = Paslon::all();
        return view('livewire.mobile.input-suara', compact(['listPaslon']));
    }
}
