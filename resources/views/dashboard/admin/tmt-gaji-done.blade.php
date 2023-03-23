<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section -->
@section('content')
<div class="container-fluid"> 

    <h1 class="mt-4">TMT Gaji Selesai Di Proses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Gaji Berkala Selesai Di Proses</li>
    </ol>

    <div class="row">
        <div class="col">
            <div class="table">
                <table>
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>TMT Gaji Lama</th>
                        <th>TMT Gaji Baru</th>
                        <th>Waktu Di Proses</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @if($tmt_gaji_dones->count())
                        @foreach($tmt_gaji_dones as $tmt_gaji_done)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tmt_gaji_done->pegawai ? $tmt_gaji_done->pegawai->nama : null }}</td>
                            <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($tmt_gaji_done->tmt_gaji_lama)->format('d-m-Y') }}</td>
                            <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($tmt_gaji_done->tmt_gaji_baru)->format('d-m-Y') }}</td>
                            <td >
                                {{ \Carbon\Carbon::parse($tmt_gaji_done->tanggal_diproses)->format('d-m-Y') }}<br>
                                {{ \Carbon\Carbon::parse($tmt_gaji_done->tanggal_diproses)->format('H:i:s') }}
                            </td>
                            <td>{{ \Carbon\Carbon::create($tmt_gaji_done->tanggal_diproses)->diffForHumans() }} selesai diproses</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7">Tidak ada yang selesai diproses.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection