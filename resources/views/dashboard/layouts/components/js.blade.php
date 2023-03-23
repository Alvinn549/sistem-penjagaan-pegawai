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
<!-- dashboard -->
<script src="{{ asset('js/dashboard/scripts.js') }}"></script>
<!-- jquery -->
<script src="{{ asset('jQuery-3.6.0/jquery-3.6.0.js') }}"></script>
<!-- datatables -->
<script src="{{ asset('DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('DataTables/Responsive-2.3.0/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('DataTables/FixedHeader-3.2.4/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('DataTables/FixedHeader-3.2.4/js/fixedHeader.bootstrap5.min.js') }}"></script>
<!-- Sweetalert  -->
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

<!-- <script>
 $(document).ready( function () {
  var table = $('#persyaratan-gaji-table').DataTable( {
    dom: 'rt',
    paging:   false,
    responsive: true,
    fixedHeader: true,
    hover: false,
  });
} );
</script> -->

<script>
    // datatables
    /*
    $(document).ready( function () {
      var table = $('#persyaratan-gaji-table').DataTable( {
        dom: 'rt',
        paging:   false,
        responsive: true,
        fixedHeader: true,
        hover: false,
      });
    } );
    */

    //modal  create pegawai 
    $('#btn-store-pegawai').click(function(event) {
      var formObject = document.forms['store'];
      event.preventDefault(); 
      swal({
        title: "Simpan data ini ?",
        text: "Perhatian data akan disimpan !",
        icon: "info",
        buttons: true,
      })
      .then((willStore) => {
        if (willStore) {
          formObject.submit();
        }
      });
    });

    //modal  create admin 
    $('#btn-store-admin').click(function(event) {
      var formObject = document.forms['store'];
      event.preventDefault(); 
      swal({
        title: "Simpan data ini ?",
        text: "Perhatian data akan disimpan !",
        icon: "info",
        buttons: true,
      })
      .then((willStore) => {
        if (willStore) {
          formObject.submit();
        }
      });
    });

    //modal  create persyaratan gaji, pangkat, pensiun 
    $('#btn-create-modal-persyaratan').click(function(event) {
      var formObject = document.forms['store'];
      event.preventDefault(); 
      swal({
        title: "Simpan data ini ?",
        text: "Perhatian data akan disimpan !",
        icon: "info",
        buttons: true,
      })
      .then((willStore) => {
        if (willStore) {
          formObject.submit();
        }
      });
    });

    // modal update pegawai
    $('#btn-update-pegawai').click(function(event) {
      var formObject = document.forms['update'];
      event.preventDefault(); 
      swal({                                   
        title: "Perbarui data ini ?",
        text: "Perhatian data akan diperbarui !",
        icon: "info",
        buttons: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          formObject.submit();
        }
      });
    });

    // modal update user
    $('#btn-update-user').click(function(event) {
      var formObject = document.forms['update-user-login'];
      event.preventDefault(); 
      swal({                                   
        title: "Perbarui data ini ?",
        text: "Perhatian data akan diperbarui !",
        icon: "info",
        buttons: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          formObject.submit();
        }
      });
    });

     // modal update settings
     $('#btn-update-settings').click(function(event) {
      var formObject = document.forms['update-settings'];
      event.preventDefault(); 
      swal({                                   
        title: "Perbarui data ini ?",
        text: "Perhatian data akan diperbarui !",
        icon: "info",
        buttons: true,
      })
      .then((willUpdate) => {
        if (willUpdate) {
          formObject.submit();
        }
      });
    });

    // confirm dialog delete pegawai, admin, persyaratan
    $('.show-alert-delete-box').click(function(event){
      var form =  $(this).closest("form");
      event.preventDefault();
      swal({
        title: "Hapus data ini ?",
        text: "Perhatian data yang sudah di hapus tidak dapat dikembalikan !",
        icon: "warning",
        dangerMode: true,
        buttons: true,
      }).then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
    });
    
    // Show entries ==> pagination
    // function autoSubmit()
    // {
    //   var formObject = document.forms['showEntries'];
    //   formObject.submit();
    // }
    
    // Show password checkbox
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    // Show confirm password checkbox
    function showConfirmPassword() {
      var x = document.getElementById("confirm_password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    
  </script>  

  <!-- Error validation -->
  @if(count($errors))
  @foreach($errors->all() as $error)
  <script>
    var klik = document.getElementById('btn-create-modal');
    klik.click()
  </script>
  @endforeach
  @endif

