<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section -->
@section('content')
<div class="container-fluid"> 

    <h1 class="mt-4">TMT Gaji Menunggu Di Proses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">TMT Gaji Menunggu Di Proses</li>
    </ol>
    
    @if($count > 0)
    @foreach($tmt_gaji_lists as $tmt_gaji_list)
    @if(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2) <= \Carbon\Carbon::today())

    <!-- Modal update tmt gaji -->
    @include('dashboard.admin.components.modal-process-update-tmt-gaji')

    <!-- Modal update persyaratan gaji -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-gaji')

    @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)) <= 61)

    <!-- Modal update tmt -->
    @include('dashboard.admin.components.modal-process-update-tmt-gaji')

    <!-- Modal update persyaratan gaji -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-gaji')

    @else
    @endif
    @endforeach
    @endif

    <div class="row">
        <div class="col">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th >TMT Gaji Berkala</th>
                            <th>Tanggal Jatuh Gaji Berkala</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @if($count > 0)
                        @foreach($tmt_gaji_lists as $tmt_gaji_list)

                        @if(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2) < \Carbon\Carbon::today())
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_gaji_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') }}
                            </td>
                            <td class="text-danger" style="font-weight: bold; white-space: nowrap;">
                                {{ \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2), true, false, 2) }} yang lalu jadwal gaji berkala
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#modal-procces-tmt-gaji-{{ $tmt_gaji_list->id }}"><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-tmt-gaji-{{ $tmt_gaji_list->id }}"><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>
                            </td>
                        </tr>

                        @elseif(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2) == \Carbon\Carbon::today())
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_gaji_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') }}
                            </td>
                            <td class="text-success" style="font-weight: bold; white-space: nowrap;">
                                Hari ini gaji berkala
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modal-procces-tmt-gaji-{{ $tmt_gaji_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-tmt-gaji-{{ $tmt_gaji_list->id }}" ><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>
                            </td>
                        </tr>


                        @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)) <= 61)
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_gaji_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') }}
                            </td>
                            <td class="text-warning" style="font-weight: bold; white-space: nowrap;">
                                {{ $tmt_gaji_list->tmt_gaji_berkala ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2), true, false, 2) : null }} dari sekarang jadwal gaji berkala
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#modal-procces-tmt-gaji-{{ $tmt_gaji_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-tmt-gaji-{{ $tmt_gaji_list->id }}" ><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>
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