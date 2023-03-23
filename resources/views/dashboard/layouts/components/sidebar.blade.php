<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
		<div class="sb-sidenav-menu">
			<div class="nav">
				<div class="sb-sidenav-menu-heading">Menu</div>
				<a class="nav-link {{ Request::is('dashboard*') ? 'active' : ''}}" href="{{ route('dashboard') }}">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
					Dashboard
				</a>
				<a class="nav-link {{ Request::is('pegawai*') ? 'active' : ''}}" href="{{ route('pegawai.index') }}">
					<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
					Pegawai
				</a>
				<a class="nav-link {{ Request::is('admin*') ? 'active' : ''}}" href="{{ route('admin.index') }}">
					<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
					Admin
				</a>
				<a class="nav-link collapsed {{ Request::is('persyaratan/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
					Persyaratan
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav" >
						<a class="nav-link {{ Request::is('persyaratan/gaji') ? 'active' : '' }}" href="{{ route('persyaratan-gaji.index') }}" style="width: 170px;">Gaji Berkala</a>
						<a class="nav-link {{ Request::is('persyaratan/pangkat') ? 'active' : '' }}" href="{{ route('persyaratan-pangkat.index') }}" style="width: 170px;">Kenaikan Pangkat</a>
						<a class="nav-link {{ Request::is('persyaratan/pensiun') ? 'active' : '' }}" href="{{ route('persyaratan-pensiun.index') }}" style="width: 170px;">Pensiun</a>
					</nav>
				</div> 
			</div>
		</div>
		<div class="sb-sidenav-footer">
			<p id="clock" class="text-center" style="margin-bottom: -5px;"></p>
			<p class="text-center" style="margin-bottom: -5px;">{{ \Carbon\Carbon::today()->isoFormat('dddd, D MMMM Y') }}</p>
		</div>
	</nav>
</div>