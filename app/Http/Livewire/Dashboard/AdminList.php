<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class AdminList extends Component
{
    use WithPagination;

    public $search;
    public $entries_paginate; 
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    { 
        $search = '%'. $this->search. '%';
        $entries_paginate = $this->entries_paginate;

        $adm = User::where('level', 'admin');

        if (isset($search)) 
        {
            $adm->where([
                ['level', 'admin'],
                ['nama', 'like', $search]
            ])
            ->orWhere([
                ['level', 'admin'],
                ['username', 'like', $search]
            ]);
        }

        return view('livewire.dashboard.admin-list', [
            'users' => $adm->latest()->paginate($entries_paginate)
        ]);
    }
}
