<!-- TMT -->
<div class="modal fade" id="modal-procces-tmt-gaji-{{ $tmt_gaji_list->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby=" exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Tmt Gaji</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.update', $tmt_gaji_list->id) }}" method="post" id="update-tmt-gaji-{{ $tmt_gaji_list->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="process-gaji-berkala" value="{{ $tmt_gaji_list->id }}">

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3"> 
                                <label for="nama" class="form-label">Nama</label>
                                <input disabled="" type="text" name="nama" class="form-control " id="nama" value="{{ $tmt_gaji_list->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="tmt_gaji_berkala_lama" class="form-label">TMT Gaji Berkala Lama</label>
                                <input disabled="" type="date" name="tmt_gaji_berkala_lama" class="form-control " id="tmt_gaji_berkala_lama" value="{{ $tmt_gaji_list->tmt_gaji_berkala }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tmt_gaji_berkala" class="form-label">TMT Gaji Berkala Baru</label>
                                <input type="date" name="tmt_gaji_berkala" class="form-control " id="tmt_gaji_berkala" value="{{ \Carbon\Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('Y-m-d') }}">
                                @error('tmt_gaji_berkala')
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
                <button type="button" class="btn btn-success btn-update-tmt" onclick="processGajiBerkala{{ $tmt_gaji_list->id }}()"><i class="fa-solid fa-floppy-disk me-2"></i>Selesai</button>
            </div>
        </div>
    </div>
</div>

<script>
    function processGajiBerkala{{ $tmt_gaji_list->id }}(){
        var form =  document.getElementById('update-tmt-gaji-{{ $tmt_gaji_list->id }}');
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