<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMPEG PEMERINTAH KOTA BANJARMASIN</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @toastr_css
</head>

<body class="hold-transition login-page" style="background-image:url('/bg/bg4.jpg');background-size:cover">
    <div class="login-box">
        <div class="login-logo">
            <img src="/bg/logo.png" width="80%"><br />
            <h5 style="color:aliceblue">PEMERINTAH KOTA BANJARMASIN</h5>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="border-radius: 20px; ">
                <p class="login-box-msg">Masukkan Akun Anda</p>

                <form class="form" action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" value="{{old('username')}}"
                            placeholder="Username" autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" value="{{old('password')}}"
                            placeholder="Password" autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>

            <!-- /.login-card-body -->
        </div>
        <div class="social-auth-links text-center mb-0 mt-10">
            <p style="color:white">Versi 1.0.0</p>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/theme/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/theme/dist/js/adminlte.min.js"></script>

    @toastr_js
    @toastr_render
</body>

</html>