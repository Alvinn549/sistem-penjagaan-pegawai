<!-- Modal Form -->
<div class="modal fade" id="modal-create-pegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('pegawai.store') }}" method="post"id="store">
          @csrf
          <div class="row">
            <div class="col-8">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="nip" class="form-label">Nip</label>
                <input type="number" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip') }}">
                @error('nip')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="pendidikan_capeg" class="form-label">Pendidikan Capeg</label>
                <input type="text" name="pendidikan_capeg" class="form-control @error('pendidikan_capeg') is-invalid @enderror" id="pendidikan_capeg" value="{{ old('pendidikan_capeg') }}">
                @error('pendidikan_capeg')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="pendidikan _terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan _terakhir" value="{{ old('pendidikan_terakhir') }}">
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
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{ old('jabatan') }}">
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
                    <input type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror" id="golongan" value="{{ old('golongan') }}">
                    @error('golongan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="eselon" class="form-label">Eselon</label>
                    <select name="eselon" class="form-control form-select @error('eselon') is-invalid @enderror">
                      <option value="">Open This Select Menu</option>
                      <option value="II A" {{ old('eselon') == 'II A' ? 'selected' : '' }}>II A</option>
                      <option value="II B" {{ old('eselon') == 'II B' ? 'selected' : '' }}>II B</option>
                      <option value="III A" {{ old('eselon') == 'III A' ? 'selected' : '' }}>III A</option>
                      <option value="III B" {{ old('eselon') == 'II B' ? 'selected' : '' }}>III B</option>
                      <option value="Non Eselon" {{ old('eselon') == 'Non Eselon' ? 'selected' : '' }}>Non Eselon</option>
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
            <div class="col">
              <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tmt_capeg" class="form-label">TMT Capeg</label>
                <input type="date" name="tmt_capeg" class="form-control @error('tmt_capeg') is-invalid @enderror" id="tmt_capeg" value="{{ old('tmt_capeg') }}">
                @error('tmt_capeg')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tmt_gaji_berkala" class="form-label">TMT Gaji Berkala</label>
                <input type="date" name="tmt_gaji_berkala" class="form-control @error('tmt_gaji_berkala') is-invalid @enderror" id="tmt_gaji_berkala" value="{{ old('tmt_gaji_berkala') }}">
                @error('tmt_gaji_berkala')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tmt_p_terakhir" class="form-label">TMT P Terakhir</label>
                <input type="date" name="tmt_p_terakhir" class="form-control @error('tmt_p_terakhir') is-invalid @enderror" id="tmt_p_terakhir" value="{{ old('tmt_p_terakhir') }}">
                @error('tmt_p_terakhir')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="d-flex">
                <input class="ms-auto" type="reset" value="Reset">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-store-pegawai" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>