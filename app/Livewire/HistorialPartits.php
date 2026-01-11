<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Partit;
use Livewire\WithPagination; // Opcional si vols paginació

class HistorialPartits extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $partits = Partit::with(['equipLocal', 'equipVisitant', 'estadi'])
            ->whereHas('equipLocal', fn($q) => $q->where('nom', 'like', '%' . $this->search . '%'))
            ->orWhereHas('equipVisitant', fn($q) => $q->where('nom', 'like', '%' . $this->search . '%'))
            ->orderBy('data', 'desc')
            ->get();

        return view('livewire.historial-partits', compact('partits'));
    }
}