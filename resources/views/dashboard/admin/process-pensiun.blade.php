<!-- Main Layout --> 
@extends('dashboard.layouts.main') 
<!-- Section --> 
@section('content')
<div class="container-fluid">

    <h1 class="mt-4">Pegawai Pensiun Menunggu Di Proses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pegawai Pensiun Menunggu Di Proses</li>
    </ol>
     @if($count > 0) 
    @foreach($tmt_pensiun_lists as $tmt_pensiun_list)
    @if(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth() <= \Carbon\Carbon::today())

    <!-- Modal update tmt pensiun -->
    @include('dashboard.admin.components.modal-process-pensiun')

    <!-- Modal update persyaratan pensiun -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-pensiun')

    @elseif(\Carbon\Carbon::today()->diffInMonths(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth()) <= 12)

    <!-- Modal update tmt pensiun -->
    @include('dashboard.admin.components.modal-process-pensiun')

    <!-- Modal update persyaratan pensiun -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-pensiun')

    @else
    @endif
    @endforeach
    @endif

    <div class="row mt-5">
        <div class="col">
         <div class="table">
            <table>
                <thead>
                    <tr>
                     <th>No</th>
                     <th>Nama</th>
                     <th>TMT Pensiun</th>
                     <th>Keterangan</th>
                     <th>Aksi</th>
                 </tr>
             </thead>
             <tbody>
                @if($count > 0)
                @foreach($tmt_pensiun_lists as $tmt_pensiun_list)

                @if(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth() < \Carbon\Carbon::today())
                <tr>
                    <td style="font-weight: bold;">{{ $loop->iteration }}</td>
                    <td >{{ $tmt_pensiun_list->nama }}</td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth()->format('d-m-Y') }}
                    </td>
                    <td class="text-danger" style="font-weight: bold; white-space: nowrap;">
                        {{ \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth(), true, false, 2)  }} yang lalu jadwal pensiun
                    </td>
                    <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#modal-proccess-pensiun-{{ $tmt_pensiun_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-pensiun-{{ $tmt_pensiun_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Persyaratan</button>
                    </td>
                </tr>

                @elseif(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth() == \Carbon\Carbon::today())
                <tr>
                    <td style="font-weight: bold;">{{ $loop->iteration }}</td>
                    <td >{{ $tmt_pensiun_list->nama }}</td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth()->format('d-m-Y') }}
                    </td>
                    <td class="text-success" style="font-weight: bold; white-space: nowrap;">
                        Hari ini jadwal berkala
                    </td>
                    <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modal-proccess-pensiun-{{ $tmt_pensiun_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-pensiun-{{ $tmt_pensiun_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Persyaratan</button>
                    </td>
                </tr>

                @elseif(\Carbon\Carbon::today()->diffInMonths(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth()) <= 12)
                <tr>
                    <td style="font-weight: bold;">{{ $loop->iteration }}</td>
                    <td >{{ $tmt_pensiun_list->nama }}</td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth()->format('d-m-Y') }}
                    </td>
                    <td class="text-warning" style="font-weight: bold; white-space: nowrap;">
                        {{ \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->startOfMonth(), true, false, 2)  }} dari sekarang jadwal pensiun
                    </td>
                    <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#modal-proccess-pensiun-{{ $tmt_pensiun_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-pensiun-{{ $tmt_pensiun_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Persyaratan</button>
                    </td>
                </tr>

                @else
                @endif
                @endforeach
                @else
                <tr>
                    <td colspan="6">Tidak ada yang perlu diproses..</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
@endsection