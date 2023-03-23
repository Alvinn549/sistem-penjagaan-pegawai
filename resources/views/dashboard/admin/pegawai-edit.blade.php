<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section -->
@section('content')
<div class="container-fluid mt-3 mb-3">
  <h1 class="mt-4">Edit Pegawai</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
    <li class="breadcrumb-item active">Edit Pegawai</li>
  </ol>

  <div class="row mt-5 mb-5 justify-content-center">
    <div class="col-md-8"> 
      <div class="card card-edit shadow"> 
        <div class="card-body">
          <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post" id="update">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-8">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') ? old('nama') : $pegawai->nama }}">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="nip" class="form-label">Nip</label>
                  <input type="number" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip') ? old('nip') : $pegawai->nip }}">
                  @error('nip')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="pendidikan_capeg" class="form-label">Pendidikan Capeg</label>
                  <input type="text" name="pendidikan_capeg" class="form-control @error('pendidikan_capeg') is-invalid @enderror" id="pendidikan_capeg" value="{{ old('pendidikan_capeg') ? old('pendidikan_capeg') : $pegawai->pendidikan_capeg }}">
                  @error('pendidikan_capeg')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="pendidikan _terakhir" class="form-label">Pendidikan Terakhir</label>
                  <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan _terakhir" value="{{ old('pendidikan_terakhir') ? old('pendidikan_terakhir') : $pegawai->pendidikan_terakhir }}">
                  @error('pendidikan_terakhir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="jabatan" class="form-label">Jabatan</label>
                      <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{ old('jabatan') ? old('jabatan') : $pegawai->jabatan }}">
                      @error('jabatan')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="golongan" class="form-label">Golongan</label>
                      <input type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror" id="golongan" value="{{ old('golongan') ? old('golongan') : $pegawai->golongan }}">
                      @error('golongan')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="eselon" class="form-label">eselon</label>
                      <select name="eselon" id="eselon" class="form-control form-select @error('eselon') is-invalid @enderror" aria-label="select example">
                        <option value="">Open this select menu</option>

                        <option value="II A" @if(old('eselon')) {{ old('eselon') == 'II A' ? 'selected' : '' }} @else {{ $pegawai->eselon == 'II A' ? 'selected' : '' }} @endif >II A</option>
                        <option value="II B" @if(old('eselon')) {{ old('eselon') == 'II B' ? 'selected' : '' }} @else {{ $pegawai->eselon == 'II B' ? 'selected' : '' }} @endif >II B</option>
                        <option value="III A" @if(old('eselon')) {{ old('eselon') == 'III A' ? 'selected' : '' }} @else {{ $pegawai->eselon == 'III A' ? 'selected' : '' }} @endif >III A</option>
                        <option value="III B" @if(old('eselon')) {{ old('eselon') == 'III B' ? 'selected' : '' }} @else {{ $pegawai->eselon == 'III B' ? 'selected' : '' }} @endif>III B</option>
                        <option value="Non Eselon" @if(old('eselon')) {{ old('eselon') == 'Non Eselon' ? 'selected' : '' }} @else {{ $pegawai->eselon == 'Non Eselon' ? 'selected' : '' }} @endif>Non Eselon</option>
                      </select>
                      @error('eselon')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="@if(old('tanggal_lahir')){{ old('tanggal_lahir') }}@else{{ $pegawai->tanggal_lahir }}@endif">
                  @error('tanggal_lahir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tmt_capeg" class="form-label">TMT Capeg</label>
                  <input type="date" name="tmt_capeg" class="form-control @error('tmt_capeg') is-invalid @enderror" id="tmt_capeg" value="@if(old('tmt_capeg')){{ old('tmt_capeg') }}@else{{ $pegawai->tmt_capeg }}@endif">
                  @error('tmt_capeg')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tmt_gaji_berkala" class="form-label">TMT Gaji Berkala</label>
                  <input type="date" name="tmt_gaji_berkala" class="form-control @error('tmt_gaji_berkala') is-invalid @enderror" id="tmt_gaji_berkala" value="@if(old('tmt_gaji_berkala')){{ old('tmt_gaji_berkala') }}@else{{ $pegawai->tmt_gaji_berkala }}@endif">
                  @error('tmt_gaji_berkala')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tmt_p_terakhir" class="form-label">TMT P Terakhir</label>
                  <input type="date" name="tmt_p_terakhir" class="form-control @error('tmt_p_terakhir') is-invalid @enderror" id="tmt_p_terakhir" value="@if(old('tmt_p_terakhir')){{ old('tmt_p_terakhir') }}@else{{ $pegawai->tmt_p_terakhir }}@endif">
                  @error('tmt_p_terakhir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <a href="{{ route('pegawai.index') }}" class="btn btn-secondary me-2">Batal</a>
              <button class="btn btn-success ms-2" id="btn-update-pegawai"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection