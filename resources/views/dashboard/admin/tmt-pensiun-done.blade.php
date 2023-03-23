<!-- Main Layout -->
@extends('dashboard.layouts.main') 
<!-- Section -->
@section('content')
<div class="container-fluid">

    <h1 class="mt-4">TMT Pensiun Selesai Di Proses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pegawai Pensiun Selesai Di Proses</li>
    </ol>

    <div class="row mt-5">
        <div class="col">
            <div class="table">
                <table id="myTable">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nip</th>
                        <th>Jabatan & Golongan</th>
                        <th>TMT Pensiun</th>
                        <th>Tanggal Di Proses</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @if($tmt_pensiun_dones->count())
                        @foreach($tmt_pensiun_dones as $tmt_pensiun_done)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tmt_pensiun_done->pegawai ? $tmt_pensiun_done->pegawai->nama : null }}</td>
                            <td style="white-space: nowrap;">{{ $tmt_pensiun_done->pegawai->nip }}</td>
                            <td>
                                <p>{{  $tmt_pensiun_done->pegawai->jabatan }}</p>
                                <p>{{  $tmt_pensiun_done->pegawai->golongan }}</p>
                            </td>
                            <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($tmt_pensiun_done->pegawai->tmt_pensiun)->format('d-m-Y') }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pensiun_done->tanggal_diproses)->format('d-m-Y') }}<br>
                                {{ \Carbon\Carbon::parse($tmt_pensiun_done->tanggal_diproses)->format('H:i:s') }}
                            </td>
                            <td>{{ \Carbon\Carbon::create($tmt_pensiun_done->tanggal_diproses)->diffForHumans() }} selesai diproses</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Tidak ada yang selesai diproses..</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection