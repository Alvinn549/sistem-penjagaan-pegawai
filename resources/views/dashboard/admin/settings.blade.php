<!-- Main Layout -->
@extends('dashboard.layouts.main')
<!-- Section -->
@section('content')

<div class="container-fluid">
	<h1 class="mt-4">Settings</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item active">Settings</li>
	</ol> 

	<div class="row mb-5 justify-content-center">
		<div class="col-md-7">
			<div class="card card-edit shadow">
				<div class="card-body">
					<form action="{{ route('settings.update-user-login', $user->id) }}" method="post" id="update-settings">
						@csrf
						@method('PUT')

						<div class="mb-3">
							<label for="nama" class="form-label">Nama</label>
							<input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="@if(old('nama')){{ old('nama') }}@else{{ $user->nama }}@endif">
							@error('nama')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="@if(old('username')){{ old('username') }}@else{{ $user->username }}@endif">
							@error('username')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="mb-1">
							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="@if(old('password')){{ old('password') }}@else{{ $user->password }}@endif">
							@error('password')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" onclick="showPassword()">Show password
						</div>
						<div class="mb-1">
							<label for="confirm_password" class="form-label">Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" value="@if(old('confirm_password')){{ old('confirm_password') }}@else{{ $user->password }}@endif">
							@error('confirm_password')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" onclick="showConfirmPassword()">Show Confirm password
						</div>
						<div class="d-flex justify-content-center">
							<a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">Batal</a>

							<button class="btn btn-success ms-2" id="btn-update-settings"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>	

@endsection