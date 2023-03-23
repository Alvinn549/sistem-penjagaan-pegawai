<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Pegawai;
use Livewire\WithPagination;
use Carbon\Carbon;

class PegawaiList extends Component
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
   $search = $this->search;
   $entries_paginate = $this->entries_paginate;

   $p = Pegawai::where('status', 'aktif');

   if (isset($search)) {
    $p->where([
      ['status', 'aktif'],
      ['nama', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['nip', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['golongan', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['jabatan', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['eselon', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['pendidikan_capeg', 'like', '%'.$search.'%']
    ])
    ->orWhere([
      ['status', 'aktif'],
      ['pendidikan_terakhir', 'like', '%'.$search.'%']
    ]);
    //  ->orWhere([
    //   ['tmt_pensiun', '>', Carbon::today()->format('Y-m-d')],
    //   ['tmt_capeg', 'like', '%'.Carbon::parse($search)->format('Y-m-d').'%']
    // ])
    //  ->orWhere([
    //   ['tmt_pensiun', '>', Carbon::today()->format('Y-m-d')],
    //   ['tmt_p_terakhir', 'like', '%'.Carbon::parse($search)->format('Y-m-d').'%']
    // ])
    //  ->orWhere([
    //   ['tmt_pensiun', '>', Carbon::today()->format('Y-m-d')],
    //   ['tmt_gaji_berkala', 'like', '%'.Carbon::parse($search)->format('Y-m-d').'%']
    // ])
    //  ->orWhere([
    //   ['tmt_pensiun', '>', Carbon::today()->format('Y-m-d')],
    //   ['tmt_pensiun', 'like', '%'.Carbon::parse($search)->format('Y-m-d').'%']
    // ]);
  }

  return view('livewire.dashboard.pegawai-list',[
    'pegawais' => $p->latest()->paginate($entries_paginate)
  ]);
}
}
