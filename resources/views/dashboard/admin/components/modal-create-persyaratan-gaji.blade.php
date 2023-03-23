 <div class="modal fade" id="modal-create-persyaratan-gaji"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah persyaratan gaji</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('persyaratan-gaji.create') }}" method="post" id="store">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input required type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}">
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
            <button type="button" class="btn btn-success" id="btn-create-modal-persyaratan">Simpan</button>
        </div>
    </div>
</div>
</div>