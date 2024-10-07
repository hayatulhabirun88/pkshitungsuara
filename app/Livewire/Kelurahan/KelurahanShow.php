<?php

namespace App\Livewire\Kelurahan;

use App\Models\Kelurahan;
use Livewire\Component;
use Livewire\WithPagination;

class KelurahanShow extends Component
{
    use WithPagination;
    public function render()
    {
        $kelurahan = Kelurahan::latest()->paginate(10);
        return view('livewire.kelurahan.kelurahan-show', compact(['kelurahan']));
    }
}
