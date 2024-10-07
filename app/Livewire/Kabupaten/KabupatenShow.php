<?php

namespace App\Livewire\Kabupaten;

use Livewire\Component;
use App\Models\Kabupaten;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class KabupatenShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $nama_kabupaten, $selectedId;
    public $listKabupaten = [];


    public function render()
    {
        $kabupaten = Kabupaten::latest()->paginate(10);
        return view('livewire.kabupaten.kabupaten-show', compact(['kabupaten']));
    }
}
