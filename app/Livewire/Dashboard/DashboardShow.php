<?php

namespace App\Livewire\Dashboard;

use App\Models\Tps;
use App\Models\Saksi;
use App\Models\Paslon;
use Livewire\Component;

class DashboardShow extends Component
{
    public function render()
    {
        $totalPaslon = Paslon::count();
        $totalSaksi = Saksi::count();
        $totalTps = Tps::count();
        return view('livewire.dashboard.dashboard-show', compact(['totalPaslon', 'totalSaksi', 'totalTps']));
    }
}
