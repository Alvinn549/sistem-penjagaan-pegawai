<!-- Main Layout -->
@extends('dashboard.layouts.main')
 
@section('content')   
<div class="container-fluid"> 

    <h1 class="mt-4">TMT Pangkat Menunggu Diproses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">TMT Pangkat Menunggu Diproses</li>
    </ol> 

    @if($count > 0)
    @foreach($tmt_pangkat_lists as $tmt_pangkat_list)
    @if(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4) <= \Carbon\Carbon::today())

    <!-- Modal update tmt pangkat -->
    @include('dashboard.admin.components.modal-process-update-tmt-pangkat')

    <!-- Modal update persyaratan pangkat -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-pangkat')

    @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)) <= 61)

    <!-- Modal update tmt pangkat -->
    @include('dashboard.admin.components.modal-process-update-tmt-pangkat')

    <!-- Modal update persyaratan pangkat -->
    @include('dashboard.admin.components.modal-process-update-persyaratan-pangkat')

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
                            <th>TMT Pangkat Terakhir</th>
                            <th>Tanggal Jatuh Naik Pangkat</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @if($count > 0)
                        @foreach($tmt_pangkat_lists as $tmt_pangkat_list)

                        @if(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4) < \Carbon\Carbon::today())
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_pangkat_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') }}
                            </td>
                            <td class="text-danger" style="font-weight: bold; white-space: nowrap;">
                                {{ \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4), true, false, 2)  }} yang lalu jadwal naik pangkat
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#modal-proccess-tmt-pangkat-{{ $tmt_pangkat_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}"><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>

                            </td>
                        </tr>

                        @elseif(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4) == \Carbon\Carbon::today())
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_pangkat_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') }}
                            </td>
                            <td class="text-success" style="font-weight: bold; white-space: nowrap;">
                                Hari ini jadwal kenaikan pangkat
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modal-proccess-tmt-pangkat-{{ $tmt_pangkat_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}"><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>

                            </td>
                        </tr>

                        @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)) <= 61)
                        <tr>
                            <td style="font-weight: bold;">{{ $no++ }}</td>
                            <td >{{ $tmt_pangkat_list->nama }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->format('d-m-Y') }}
                            </td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') }}
                            </td>
                            <td class="text-warning" style="font-weight: bold; white-space: nowrap;">
                                {{ \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4), true, false, 2)  }} dari sekarang jadwal naik pangkat
                            </td>
                            <td style="white-space: nowrap;">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-proccess-tmt-pangkat-{{ $tmt_pangkat_list->id }}" ><i class="fa-solid fa-bars-progress me-2"></i>Proses</button>

                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-proccess-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}"><i class="fa-solid fa-columns me-2"></i>Persyaratan</button>

                            </td>
                        </tr>
                        @else
                        @endif
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" >Tidak ada yang perlu diproses..</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection