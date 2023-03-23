<div class="container-fluid">
    <!-- Modal Create Admin -->
    @include('dashboard/admin/components/modal-create-admin')

    <h1 class="mt-4">Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Admin</li>
    </ol>

    @forelse($users as $user)
    <div class="modal fade" id="deleteAdmin{{ $user->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus user</h5>
                </div>
                <div class="modal-body">
                    <p class="mt-3">Apakah anda yakin untuk <strong>Menghapus</strong> {{ $user->nama }} ?</p>
                </div>
                <div class="modal-footer">
                 <form action="{{ route('admin.destroy', $user->id) }}" method="post" id="destroy-{{ $user->id }}">
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
        <button class="btn mt-5" data-bs-toggle="modal" data-bs-target="#modal-create-admin" id="btn-create-modal">
            <i class="fa-solid fa-plus me-2"></i>Data
        </button>
    </div>
    <div class="col-md-3 ms-auto">
        <div class="d-flex">
            <h1 style="font-size: 18px; margin-top: 7px;" class="me-2">Show</h1>
            <select class="form-control form-select mb-2"  wire:model="entries_paginate" style="width: 76px;">
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
            </select>
            <h1  style="font-size: 18px; margin-top: 7px;" class="ms-2">entries</h1>
        </div>
        <!-- Pagination Links -->
        {{ $users->links() }}
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="table">
            <div class="row mt-3 me-3">
                <div class="col-md-3 ms-auto">
                    <input type="text" class="form-control" placeholder="Cari admin" wire:model="search" style="background-color: white;" />
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->count())
                    @foreach($users as $key => $user)
                    <tr>
                        <td style="font-weight: bold;">{{ $users->firstItem() + $key }}</td>
                        <td >{{ $user->nama }}</td>
                        <td >{{ $user->username }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y H:i:s') }}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Aksi</a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="d-flex mb-2 justify-content-center">
                                        <a style="width: 130px" class="btn btn-warning text-light" href="{{ route('admin.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                                    </li>
                                    <li class="d-flex mb-2 justify-content-center">
                                        <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdmin{{ $user->id }}" style="width: 130px"><i class="fa-solid fa-trash-can me-2"></i>Hapus
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
                        <td colspan="11">
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
