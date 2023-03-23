<div class="modal fade" id="confirm-dialog-logout"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Logout</h5>
			</div>
			<div class="modal-body">
				<p class="mt-3">Apakah anda yakin untuk keluar ?</p>
			</div>
			<div class="modal-footer">
				<form action="{{ route('logout') }}" method="post">
					@csrf
					<button type="button" class="btn btn-secondary me-2 logoutBtn logoutCancel" data-bs-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-danger ms-2 logoutBtn">Ya</button>
				</form>
			</div>
		</div>
	</div>
</div>