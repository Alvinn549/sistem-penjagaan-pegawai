<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section --> 
@section('content')
<div class="container-fluid"> 

    <h1 class="mt-4">Pensiun</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Persyaratan</li>
        <li class="breadcrumb-item active">Pensiun</li>
    </ol>

    @include('dashboard.admin.components.modal-create-persyaratan-pensiun')

    @foreach($persyaratanPensiuns as $persyaratanPensiun)
    <div class="modal fade" id="modal-update-persyaratan-pensiun-{{ $persyaratanPensiun->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update persyaratan gaji</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('persyaratan-pensiun.update', $persyaratanPensiun->id) }}" method="post" id="update-persyaratan-{{ $persyaratanPensiun->id }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama persyaratan</label>
                            <input required type="text" name="nama" class="form-control " id="nama" value="{{ $persyaratanPensiun->nama }}">
                            @error('nama')
                            <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-2 " data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="updatePersyaratan{{ $persyaratanPensiun->id }}()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updatePersyaratan{{ $persyaratanPensiun->id }}(){
        var form =  document.getElementById('update-persyaratan-{{ $persyaratanPensiun->id }}');
        event.preventDefault();
        swal({
            title: "Apakah anda yakin untuk memperbarui data ini ?",
            icon: "info",
            buttons: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                form.submit();
            }
        });
    }
</script>
@endforeach

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-body">
                <h1 class="display-5 text-center mb-5" style="font-size: 30px;">Daftar Persyaratan Pensiun</h1>
                <div class="row">
                    <div class="col">
                        <ol type="1" >
                            @if($persyaratanPensiuns->count())
                            @foreach($persyaratanPensiuns as $persyaratanPensiun)
                            <div class="row mb-3">
                                <div class="col">
                                    <li >{{ $persyaratanPensiun->nama }}</li>
                                </div>
                                <div class="col">
                                    <div class="d-flex">
                                        <form class="ms-auto" action="{{ route('persyaratan-pensiun.delete', $persyaratanPensiun->id) }}" method="post" id="destroy-{{ $persyaratanPensiun->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#modal-update-persyaratan-pensiun-{{ $persyaratanPensiun->id }}">Edit</button>

                                            <button type="button" class="btn btn-danger btn-flat show-alert-delete-box" data-toggle="tooltip" title='Delete'>Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </ol>
                        @else
                        <p class="text-center">Belum ada persyaratan...</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex">
                            <button class="btn ms-auto" data-bs-toggle="modal" data-bs-target="#modal-create-persyaratan-pensiun" id="btn-create-modal" style="width: 127px;"><i class="fa-solid fa-plus me-2"></i>Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>
@endsection