@extends('dashboard.layouts.main')

@section('content')
<div class="container-fluid"> 

    <h1 class="mt-4">TMT Pangkat Selesai Diproses</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Kenaikan Pangkat Selesai Diproses</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="table">
                <table>
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>TMT Pangkat Lama</th>
                        <th>TMT Pangkat Baru</th>
                        <th>Waktu Di Proses</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @if($tmt_pangkat_dones->count())
                        @foreach($tmt_pangkat_dones as $tmt_pangkat_done)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tmt_pangkat_done->pegawai ? $tmt_pangkat_done->pegawai->nama : null }}</td>
                            <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($tmt_pangkat_done->tmt_pangkat_lama)->format('d-m-Y') }}</td>
                            <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($tmt_pangkat_done->tmt_pangkat_baru)->format('d-m-Y') }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($tmt_pangkat_done->tanggal_diproses)->format('d-m-Y') }}<br>
                                {{ \Carbon\Carbon::parse($tmt_pangkat_done->tanggal_diproses)->format('H:i:s') }}
                            </td>
                            <td>{{ \Carbon\Carbon::create($tmt_pangkat_done->tanggal_diproses)->diffForHumans() }} selesai diproses</td>
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