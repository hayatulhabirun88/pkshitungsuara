<?php

namespace App\Livewire\Kecamatan;

use Livewire\Component;
use App\Models\Kecamatan;
use Livewire\WithPagination;

class KecamatanShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $kecamatan = Kecamatan::latest()->paginate(10);
        return view('livewire.kecamatan.kecamatan-show', compact(['kecamatan']));
    }
}
