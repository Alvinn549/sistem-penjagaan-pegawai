<!doctype html>
  <html lang="en">
  <head>   
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('icon/kominfo.png') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <!-- my css -->
    <link rel="stylesheet" href="{{ asset('css/mycss/style.css') }}">
    <!-- fontawesome -->
    <script src="{{ asset('fontawesome-free-6.1.1/js/all.js') }}"></script>
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.css') }}"/>
    <link rel="stylesheet" href="{{ asset('DataTables/Responsive-2.3.0/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/FixedHeader-3.2.4/css/fixedHeader.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.12.1/css/jquery.dataTables.min.css') }}">

    <title>Penjagaan Pegawai Diskominfo</title>

  </head>
  <body>
    <div class="card">
      <!-- <div class="position-absolute ms-auto">
        @auth
        <a href="{{ route('dashboard') }}" class="text-center px-3 py-2 loginTxt">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-center  px-3 py-2 loginTxt">Login</a>
        @endauth
      </div> -->
      <div class="card-body cardIndex">
        <h1 class="jumbotronTxt mt-2 display-5">PENJAGAAN PEGAWAI DINAS KOMUNIKASI DAN INFORMATIKA<br>KABUPATEN PACITAN</h1>
        <div class="d-flex justify-content-center" >
          <div id="clock" class="today display-5 me-1"></div>
          <p class="today display-5 ms-1">{{ \Carbon\Carbon::today()->isoFormat('dddd, D MMMM Y') }}</p>
        </div>
      </div>
    </div>

    <div class="container-xxl p-5">

      @forelse($pegawais as $pegawai)
      <!-- Modal Persyaratan Gaji Berkala -->
      <div class="modal fade" id="persyaratanBerkalaPegawai{{ $pegawai->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Persyaratan gaji berkala</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="mt-3">Nama : <strong> {{ $pegawai->nama }} </strong></p>
              @if(isset($pegawai->persyaratan['p_gaji_berkala']))
              <ul>
                @foreach($pegawai->persyaratan['p_gaji_berkala'] as $pg)
                <li>{{ $pg }}</li>
                @endforeach 
              </ul>
              @endif
            </div>
          </div>
        </div>
      </div> 
      <!-- Moda Persyaratan Pangkat  -->
      <div class="modal fade" id="persyaratanPangkatPegawai{{ $pegawai->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Persyaratan kenaikan pangkat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="mt-3">Nama : <strong> {{ $pegawai->nama }} </strong></p>
              @if(isset($pegawai->persyaratan['p_pangkat']))
              <ul>
                @foreach($pegawai->persyaratan['p_pangkat'] as $pkp)
                <li>{{ $pkp }}</li>
                @endforeach 
              </ul>
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- Moda Persyaratan Pensiun  -->
      <div class="modal fade" id="persyaratanPensiunPegawai{{ $pegawai->id }}"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Persyaratan pensiun</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="mt-3">Nama : <strong> {{ $pegawai->nama }} </strong></p>
              @if(isset($pegawai->persyaratan['p_pensiun']))
              <ul>
                @foreach($pegawai->persyaratan['p_pensiun'] as $pp)
                <li>{{ $pp }}</li>
                @endforeach 
              </ul>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      @endforelse

      <table  id="index-table" class="table order-column stripe" style="width:100%">
        <thead>
          <tr>
            <th class="text-center" scope="col" data-priority="1">No</th>
            <th class="text-center" scope="col" data-priority="2" style="white-space: nowrap;">Nama Pegawai</th>
            <th class="text-center" scope="col" >Gaji Berkala</th>
            <th class="text-center" scope="col">Kenaikan Pangkat</th>
            <th class="text-center" scope="col" >Pensiun</th>
          </tr>
        </thead>
        <tbody>
          @if($pegawais->count())
          @foreach($pegawais as $pegawai)
          <tr>
            <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
            <td data-label="Nama Pegawai" class="text-center" >{{ $pegawai->nama }}</td>
            <td data-label="Gaji Berkala" style="font-weight: bold; " class="text-center">
              <p style="display: none;">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('Y-m-d') : null }}
              </p>

              @if(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->startOfDay() < \Carbon\Carbon::today())
              <p class="text-danger">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') : null }}
              </p>
              <p class="text-danger">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2), true, false, 2) : null }} yang lalu jadwal gaji berkala
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanBerkalaPegawai{{ $pegawai->id }}">Persyaratan <i class="fa-solid fa-angle-right ms-2"></i></button>
              </p>

              @elseif(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2) == \Carbon\Carbon::today())
              <p class="text-success">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') : null }}
              </p>
              <p class="text-success">
                hari ini jadwal gaji berkala
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanBerkalaPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)) <= 61)
              <p class="text-warning">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') : null }}
              </p>
              <p class="text-warning">
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2), true, false, 2) : null }} dari sekarang jadwal gaji berkala
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanBerkalaPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @else
              <p >
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)->format('d-m-Y') : null }}
              </p>
              <p >
                {{ $pegawai->tmt_gaji_berkala ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2), true, false, 2) : null }} dari sekarang jadwal gaji berkala
              </p>
              @endif
            </td>

            <td data-label="Kenaikan Pangkat" style="font-weight: bold; " class="text-center">
              <p style="display: none;">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('Y-m-d') : null }}
              </p>

              @if(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->startOfDay() < \Carbon\Carbon::today())
              <p class="text-danger">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') : null }}
              </p>
              <p class="text-danger">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4), true, false, 2) : null }} yang lalu jadwal kenaikan pangkat
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanPangkatPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @elseif(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4) == \Carbon\Carbon::today())
              <p class="text-success">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') : null }}
              </p>
              <p class="text-success">
                hari ini jadwal kenaikan pangkat
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanPangkatPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @elseif(\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)) <= 61)
              <p class="text-warning">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') : null }}
              </p>
              <p class="text-warning">
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4), true, false, 2) : null }} dari sekarang jadwal kenaikan pangkat
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanPangkatPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @else
              <p >
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)->format('d-m-Y') : null }}
              </p>
              <p >
                {{ $pegawai->tmt_p_terakhir ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4), true, false, 2) : null }} dari sekarang jadwal kenaikan pangkat
              </p>

              @endif
            </td>

            <td data-label="Pensiun" style="font-weight: bold; "  class="text-center">
              <p style="display: none;">{{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()->format('Y-m-d') : null }}
              </p>

              @if(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth() < \Carbon\Carbon::today())
              <p class="text-danger">
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()->format('d-m-Y') : null }}
              </p>
              <p class="text-danger">
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth(), true, false, 2) : null }} yang lalu jadwal Pensiun
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanPensiunPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>
              @elseif(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth() == \Carbon\Carbon::today())
              <p class="text-success">
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()->format('d-m-Y') : null }}
              </p>
              <p class="text-success">
                hari ini jadwal pensiun
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index" data-bs-toggle="modal" data-bs-target="#persyaratanPensiunPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @elseif(\Carbon\Carbon::today()->diffInMonths(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()) <= 12)
              <p class="text-warning" >
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()->format('d-m-Y') : null }}
              </p>
              <p class="text-warning">
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth(), true, false, 2) : null }} dari sekarang jadwal pensiun
              </p>
              <p>
                <button class="btn" id="btn-modal-persyaratan-index"  data-bs-toggle="modal" data-bs-target="#persyaratanPensiunPegawai{{ $pegawai->id }}">Persyaratan</button>
              </p>

              @else
              <p >
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth()->format('d-m-Y') : null }}
              </p>
              <p >
                {{ $pegawai->tmt_pensiun ? \Carbon\Carbon::today()->diffForHumans(\Carbon\Carbon::parse($pegawai->tmt_pensiun)->startOfMonth(), true, false, 2) : null }} dari sekarang jadwal pensiun
              </p>

              @endif
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="5" style="border-bottom: none; text-align: center;">
              Data tidak ditemukan..
            </td>
          </tr> 
          @endif
        </tbody>
      </table>
    </div>

    <script>
      var clockDisplay = document.getElementById('clock');

      function startClock()
      {
        var getDate = new Date();
        let h = getDate.getHours();
        let m = getDate.getMinutes();
        let s = getDate.getSeconds();

        h = h < 10 ? "0" + h : h;
        m = m < 10 ? "0" + m : m;
        s = s < 10 ? "0" + s : s;

        clockDisplay.innerHTML = h+":"+m+":"+s;
      }
      setInterval(startClock, 1000);
    </script>

    <!-- bootstrap -->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    <!-- jquery -->
    <script src="{{ asset('jQuery-3.6.0/jquery-3.6.0.js') }}"></script>
    <!-- datatables -->
    <script src="{{ asset('DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('DataTables/Responsive-2.3.0/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('DataTables/FixedHeader-3.2.4/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('DataTables/FixedHeader-3.2.4/js/fixedHeader.bootstrap5.min.js') }}"></script>
    <script>
      $(document).ready( function () {
        var table = $('#index-table').DataTable( {
          dom: 'rt',
          paging: false,
          responsive: true,
          fixedHeader: true,
          hover: false,
          // columnDefs: [
          // { responsivePriority: 1, targets: 0 },
          // { responsivePriority: 2, targets: 0 }
          // ]
        });
      } );


    </script>
    <!-- <script>
      $(document).bind("contextMenu", function(e){
        return false;
      });
    </script> -->

  </body>
  </html>