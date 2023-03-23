<!-- TMT --> 
<div class="modal fade" id="modal-proccess-tmt-pangkat-{{ $tmt_pangkat_list->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Tmt Pangkat</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.update', $tmt_pangkat_list->id) }}" method="post" id="update-tmt-pangkat-{{ $tmt_pangkat_list->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="proccess-kenaikan-pangkat" value="{{ $tmt_pangkat_list->id }}">

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3"> 
                                <label for="nama" class="form-label">Nama</label>
                                <input disabled="" type="text" name="nama" class="form-control " id="nama" value="{{ $tmt_pangkat_list->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="tmt_p_terakhir_lama" class="form-label">TMT Pangkat Lama</label>
                                <input disabled="" type="date" name="tmt_p_terakhir_lama" class="form-control " id="tmt_p_terakhir_lama" value="{{ $tmt_pangkat_list->tmt_p_terakhir }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tmt_p_terakhir" class="form-label">TMT Pangkat Baru</label>
                                <input type="date" name="tmt_p_terakhir" class="form-control @error('tmt_p_terakhir') is-invalid @enderror" id="tmt_p_terakhir" value="{{ \Carbon\Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('Y-m-d') }}">
                                @error('tmt_p_terakhir')
                                <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2 " data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success btn-update-tmt" onclick="processKenaikanPangkat{{ $tmt_pangkat_list->id }}()"><i class="fa-solid fa-floppy-disk me-2"></i>Selesai</button>
        </div>
    </div>
</div>
</div>

<script>
    function processKenaikanPangkat{{ $tmt_pangkat_list->id }}(){
        var form =  document.getElementById('update-tmt-pangkat-{{ $tmt_pangkat_list->id }}');
        event.preventDefault();
        swal({
            title: "Perbarui data ini ?",
            text: "Perhatian data akan diperbarui !",
            icon: "info",
            buttons: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                form.submit();
            }
        });
    }
</script>