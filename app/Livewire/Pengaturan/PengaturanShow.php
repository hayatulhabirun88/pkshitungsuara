<?php

namespace App\Livewire\Pengaturan;

use App\Models\Kabupaten;
use App\Models\Kelurahan;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\Kecamatan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PengaturanShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama_paslon, $no_urut, $foto, $wilayah, $selectedId;
    public $listWilayah = [];
    public $isOpen = false;
    public $isOpenDelete = false;

    public function mount()
    {
        $this->getListWilayah();
    }

    public function setWilayah()
    {
        try {
            $client = new Client();

            $responsekabupaten = $client->request('GET', asset('/') . 'api-wilayah-indonesia/static/api/regencies/74.json');

            $kabupaten = json_decode($responsekabupaten->getBody()->getContents(), true);

            foreach ($kabupaten as $key => $kab) {

                // Update atau buat data kabupaten
                Kabupaten::updateOrCreate(
                    ['id' => $kab['id']],
                    [
                        'nama_kabupaten' => $kab['name']
                    ]
                );
            }


            $responsekecamatan = $client->request('GET', asset('/') . 'api-wilayah-indonesia/static/api/districts/' . $this->wilayah . '.json');

            // Mengambil data kecamatan dari responsekecamatan
            $kecamatan = json_decode($responsekecamatan->getBody()->getContents(), true);

            DB::beginTransaction();

            foreach ($kecamatan as $kec) {
                // Update atau buat data kecamatan
                $kecamatanData = Kecamatan::updateOrCreate(
                    ['id' => $kec['id']],
                    [
                        'kabupaten_id' => $kec['regency_id'],
                        'nama_kecamatan' => $kec['name']
                    ]
                );


                // Ambil data kelurahan dari API berdasarkan kecamatan ID
                $responsekelurahan = $client->request('GET', asset('/') . 'api-wilayah-indonesia/static/api/villages/' . $kec['id'] . '.json');
                $kelurahan = json_decode($responsekelurahan->getBody()->getContents(), true);


                // Update atau buat data kelurahan
                foreach ($kelurahan as $kel) {

                    Kelurahan::updateOrCreate(
                        ['id' => $kel['id']],
                        [
                            'kecamatan_id' => $kel['district_id'],
                            'nama_kelurahan' => $kel['name']
                        ]
                    );



                }
            }

            DB::commit();
            session()->flash('success', 'Data kecamatan dan kelurahan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

        return view('livewire.pengaturan.pengaturan-show');
    }
}
