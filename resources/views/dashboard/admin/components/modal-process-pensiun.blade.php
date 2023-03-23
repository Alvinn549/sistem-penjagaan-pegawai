<!-- TMT --> 
<div class="modal fade" id="modal-proccess-pensiun-{{ $tmt_pensiun_list->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Pensiun</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.update', $tmt_pensiun_list->id) }}" method="post" id="proccess-pensiun-{{ $tmt_pensiun_list->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="proccess-pensiun" value="{{ $tmt_pensiun_list->id }}">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3"> 
                                <label for="nama" class="form-label">Nama</label>
                                <input disabled="" type="text" name="nama" class="form-control " id="nama" value="{{ $tmt_pensiun_list->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input disabled="" type="number" name="nip" class="form-control " id="nip" value="{{ $tmt_pensiun_list->nip }}">
                            </div>
                            <div class="mb-3">
                                <label for="tmt_pensiun" class="form-label">TMT Pensiun</label>
                                <input disabled="" type="date" name="tmt_pensiun" class="form-control " id="tmt_pensiun" value="{{ \Carbon\Carbon::parse($tmt_pensiun_list->tmt_pensiun)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                               <label for="tmt_pensiun" class="form-label">Status</label>
                               <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" value="pensiun">Nyatakan pegawai ini telah pensiun
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2 " data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-success btn-update-tmt" onclick="processKenaikanPangkat{{ $tmt_pensiun_list->id }}()"><i class="fa-solid fa-floppy-disk me-2"></i>Selesai</button>
        </div>
    </div>
</div>
</div>

<script>
    function processKenaikanPangkat{{ $tmt_pensiun_list->id }}(){
        var form =  document.getElementById('proccess-pensiun-{{ $tmt_pensiun_list->id }}');
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