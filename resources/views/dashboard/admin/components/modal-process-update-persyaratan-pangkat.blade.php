<!-- Persyaratan -->
<div class="modal fade" id="modal-proccess-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Persyaratan Kenaikan Pangkat</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.update', $tmt_pangkat_list->id) }}" method="post" id="update-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}">
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
                                <label for="nama" class="form-label">Persyaratan Lama</label>
                                @if(isset($tmt_pangkat_list->persyaratan['p_pangkat']))
                                <ul>
                                    @foreach($tmt_pangkat_list->persyaratan['p_pangkat'] as $pp)
                                    <li>{{ $pp }}</li>
                                    @endforeach 
                                </ul>
                                <p class="{{ \Carbon\Carbon::parse($tmt_pangkat_list->persyaratan->updated_at) < \Carbon\Carbon::today()->subDay(61) ? 'text-danger' : '' }}">
                                    <small>Terakhir diperbarui : {{ \Carbon\Carbon::parse($tmt_pangkat_list->persyaratan->updated_at)->format('d-m-Y (H:i:s)') }}</small>
                                </p>
                                @else
                                <p>Belum ada persyaratan ditambahkan..</p>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="persyaratan_tmt_gaji_berkala" class="form-label">Tambahakan Persyaratan Yang Diperlukan</label>
                                @foreach($persyaratanPangkats as $persyaratanPangkat)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persyaratan[]" value="{{ $persyaratanPangkat->nama }}">{{ $persyaratanPangkat->nama }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-2 " data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success btn-update-tmt" onclick="processPersyaratanKenaikanPangkat{{ $tmt_pangkat_list->id }}()"><i class="fa-solid fa-floppy-disk me-2"></i>Selesai</button>
            </div>
        </div>
    </div>
</div>

<script>
    function processPersyaratanKenaikanPangkat{{ $tmt_pangkat_list->id }}(){
        var form2 =  document.getElementById('update-persyaratan-kenaikan-pangkat-{{ $tmt_pangkat_list->id }}');
        event.preventDefault();
        swal({
            title: "Perbarui data ini ?",
            text: "Perhatian data akan diperbarui !",
            icon: "info",
            buttons: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                form2.submit();
            }
        });
    }
</script>