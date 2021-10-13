<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="{{ asset('download/images/logo.png') }}" type="image/x-icon">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 30%">
        <div class="login-logo">
            <a href="#"><b>ATOMIC</b></a>
        </div>
        <!-- /.login-logo -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Gagal</h5>
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        @if (strpos($error, 'do not match'))
                            <li>Periksa kembali username dan password Anda</li>
                        @elseif (strpos($error, 'username field is required'))
                            <li>Username harus terisi</li>
                        @elseif (strpos($error, 'password field is required'))
                            <li>Password harus terisi</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">
                <h5>Berhasil</h5>
                <ul class="m-0">
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @elseif (Session::get('error'))
            <div class="alert alert-danger">
                <h5>Gagal</h5>
                <ul class="m-0">
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>

                <form action="" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 ml-auto">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin-lte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
