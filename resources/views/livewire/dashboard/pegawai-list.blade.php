<div class="container-xl-fluid">
    <!-- Modal Create Pegawai -->
    @include('dashboard/admin/components/modal-create-pegawai')

    <h1 class="mt-4">Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pegawai</li>
    </ol>

    @forelse($pegawais as $pegawai)
    <div class="modal fade" id="deletePegawai{{ $pegawai->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pegawai</h5>
                </div>
                <div class="modal-body">
                    <p class="mt-3">Apakah anda yakin untuk <strong>Menghapus</strong> {{ $pegawai->nama }} ?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="post" id="destroy-{{ $pegawai->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary me-2 logoutBtn logoutCancel" data-bs-dismiss="modal">Tidak</button>

                        <button style="width: 130px" type="submit" class="btn btn-xs btn-danger btn-flat"><i class="fa-solid fa-trash-can me-2"></i>Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse

    <div class="row mb-2">
        <div class="col-md-2">
            <button class="btn mt-5 mb-2" data-bs-toggle="modal" data-bs-target="#modal-create-pegawai" id="btn-create-modal"><i class="fa-solid fa-plus me-2"></i>Data
            </button>
        </div>
        <div class="col-md-3 ms-auto">
            <!-- <h1 style="font-size: 18px; margin-top: 7px;" class="me-2">Show</h1> -->
            <select class="form-control form-select mb-2"  wire:model="entries_paginate" style="width: 76px;">
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option> 
            </select>
            <!-- <h1  style="font-size: 18px; margin-top: 7px;" class="ms-2">entries</h1> -->
            <!-- Pagination Links -->
            {{ $pegawais->links() }}
        </div> 
    </div>
    <div class="row">
        <div class="col">
            <div class="table">
                <div class="row mt-3 me-3">
                    <div class="col-md-3 ms-auto">
                        <input type="text" class="form-control" placeholder="Cari pegawai" wire:model="search" style="background-color: white;" />
                    </div>
                </div>
                <table id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nip</th>
                            <th>Jabatan & Eselon</th>
                            <th>Golongan</th>
                            <th>Pendidikan Capeg</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Tanggal Lahir</th>
                            <th>TMT Capeg</th>
                            <th>TMT Gaji Berkala</th>
                            <th>TMT Pangkat Terakhir</th>
                            <th>TMT Pensiun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($pegawais->count()) 
                        @foreach($pegawais as $key => $pegawai)
                        <tr>
                            <td style="font-weight: bold;">{{ $pegawais->firstItem() + $key }}</td>
                            <td >{{ $pegawai->nama }}</td>
                            <td >{{ $pegawai->nip }}</td>
                            <td>
                                <p>{{ $pegawai->jabatan }}</p>
                                <p>{{ $pegawai->eselon   }}</p>
                            </td>
                            <td>
                                {{ $pegawai->golongan }} 
                            </td>
                            <td >{{ $pegawai->pendidikan_capeg }}</td>
                            <td >{{ $pegawai->pendidikan_terakhir }}</td>
                            <td style="white-space: nowrap;">{{ $pegawai->tanggal_lahir ? \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') : null }}</td>
                            <td style="white-space: nowrap;">{{ $pegawai->tmt_capeg ? \Carbon\Carbon::parse($pegawai->tmt_capeg)->format('d-m-Y') : null }}</td>
                            <td style="white-space: nowrap;">{{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->format('d-m-Y') : null }}</td>
                            <td style="white-space: nowrap;">{{ $pegawai->tmt_p_terakhir ?  \Carbon\Carbon::create($pegawai->tmt_p_terakhir)->format('d-m-Y') : null }}</td>
                            <td style="white-space: nowrap;">{{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->format('d-m-Y') : null }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Aksi
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="d-flex mb-2 justify-content-center">
                                            <a style="width: 130px" class="btn btn-warning text-light" href="{{ route('pegawai.edit', $pegawai->id) }}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                                        </li>
                                        <li class="d-flex mb-2 justify-content-center">
                                          <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#deletePegawai{{ $pegawai->id }}" style="width: 130px"><i class="fa-solid fa-trash-can me-2"></i>Hapus
                                          </button>
                                      </li>
                                      <!-- <li class="d-flex justify-content-center"><a class="btn btn-primary" href="#"><img src="{{ asset('icon/feather-icons/dist/icons/printer.svg') }}" class="me-2">Cetak</a></li> -->
                                  </ul>
                              </div>
                          </td>
                      </tr>


                      @endforeach
                      @else
                      <tr>
                        <td colspan="12">
                            Data tidak ditemukan..
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
