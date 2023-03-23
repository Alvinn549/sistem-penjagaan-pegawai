<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section -->
@section('content')
<div class="container-fluid p-4">
    <h1 >Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row mb-5">
        <div class="card shadow db-card-wrapper">
            <div class="card-body">
                <div class="row mb-3">
                    <h1 class="display-5" style="font-size: 30px;">Menunggu Diproses</h1>
                </div> 
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-6">
                        <div class="card db-card-gaji text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="text-center display-5 index-count">TMT gaji</h1>
                                        <h1 class="text-center display-5 index-count">{{ $process_tmt_gaji_count }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <img class="ceklis-icon mt-2" src="{{ asset('icon/exclamation.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between" id="view-details-tmt">
                                <a class="small text-white stretched-link"  href="{{ route('process-tmt-gaji') }}">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card db-card-pangkat text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="text-center display-5 index-count">TMT pangkat</h1>
                                        <h1 class="text-center display-5 index-count">{{ $process_tmt_pangkat_count }}</h1>
                                    </div>
                                    <div class="col-4">
                                        <img class="ceklis-icon mt-2" src="{{ asset('icon/exclamation.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="{{ route('process-tmt-pangkat') }}">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card db-card-pensiun text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                 <div class="col-8">
                                     <h1 class="text-center display-5 index-count">Pensiun</h1>
                                     <h1 class="text-center display-5 index-count">{{ $process_tmt_pensiun_count }}</h1>
                                 </div>
                                 <div class="col-4">
                                     <img class="ceklis-icon mt-2" src="{{ asset('icon/exclamation.png') }}" alt="">
                                 </div>   
                             </div>
                         </div>
                         <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('process-tmt-pensiun') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="card shadow db-card-wrapper">
        <div class="card-body">
            <div class="row mb-3">
                <h1 class="display-5" style="font-size: 30px;">Selesai Di Proses</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="card db-card-gaji-done text-white text-center mb-4">
                        <div class="card-body">
                            <div class="row" style="margin: 0 auto;">
                                <div class="col-8">
                                    <h1 class="text-center display-5 index-count">TMT gaji</h1>
                                    <h1 class="text-center display-5 index-count">{{ $tmt_gaji_done_count }}</h1>
                                </div>
                                <div class="col-4">
                                    <img class="ceklis-icon mt-2" src="{{ asset('icon/check-list.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between" id="view-details-tmt">
                            <a class="small text-white stretched-link"  href="{{ route('tmt-gaji-done') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card db-card-pangkat-done text-white text-center     mb-4">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-8">
                                    <h1 class="text-center display-5 index-count">TMT pangkat</h1>
                                    <h1 class="text-center display-5 index-count">{{ $tmt_pangkat_done_count }}</h1>
                                </div>
                                <div class="col-4">
                                    <img class="ceklis-icon mt-2" src="{{ asset('icon/check-list.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('tmt-pangkat-done') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card db-card-pensiun-done text-white mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h1 class="text-center display-5 index-count">Pensiun</h1>
                                    <h1 class="text-center display-5 index-count">{{ $tmt_pensiun_done_count }}</h1>
                                </div>
                                <div class="col-4">
                                 <img class="ceklis-icon mt-2" src="{{ asset('icon/check-list.png') }}" alt="">
                             </div>
                         </div>
                     </div>
                     <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('tmt-pensiun-done') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection