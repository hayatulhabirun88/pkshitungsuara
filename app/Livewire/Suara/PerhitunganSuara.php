<?php

namespace App\Livewire\Suara;

use Carbon\Carbon;
use App\Models\Paslon;
use Livewire\Component;

class PerhitunganSuara extends Component
{
    public function render()
    {
        $paslon = Paslon::get();
        return view('livewire.suara.perhitungan-suara', compact(['paslon']));
    }
}
