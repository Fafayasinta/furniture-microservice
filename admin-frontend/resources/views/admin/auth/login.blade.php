<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin Furniture</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>Furniture</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login untuk mengelola data</p>

      <form id="form-login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>
        <small id="error-username" class="text-danger"></small>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>
        <small id="error-password" class="text-danger"></small>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
  $(document).ready(function () {
    $('#form-login').submit(function (e) {
      e.preventDefault();

      // Bersihkan error
      $('#error-username').text('');
      $('#error-password').text('');

      let username = $('#username').val();
      let password = $('#password').val();

      $.ajax({
        url: 'http://localhost:8000/api/login', // Ganti jika endpoint-nya beda
        method: 'POST',
        data: {
          username: username,
          password: password
        },
        success: function (res) {
          if (res.status) {
            // Simpan token (bisa juga pakai sessionStorage kalau mau)
            localStorage.setItem('auth_token', res.token);

            Swal.fire({
              icon: 'success',
              title: 'Berhasil Login',
              text: res.message
            }).then(() => {
              window.location.href = '/admin/dashboard'; // ganti sesuai dashboard
            });
          } else {
            if (res.msgField) {
              if (res.msgField.username) {
                $('#error-username').text(res.msgField.username[0]);
              }
              if (res.msgField.password) {
                $('#error-password').text(res.msgField.password[0]);
              }
            }

            Swal.fire({
              icon: 'error',
              title: 'Gagal Login',
              text: res.message || 'Periksa kembali input kamu.'
            });
          }
        },
        error: function (xhr) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat menghubungi server.'
          });
        }
      });
    });
  });
</script>

</body>
</html>
