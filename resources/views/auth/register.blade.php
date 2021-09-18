<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pilarmedia Indonesia | Log in</title>
<link rel="shortcut icon" href="{{ asset('assets')}}/dist/img/favicon.png">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset('assets')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
    <a href="../../index2.html"><b>Pilarmedia</b> Indonesia</a>
</div>
<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">

        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
        </div>
    </form>
    <p class="text-center">- OR -</p>
    <p class="mb-0 text-center">
        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </p>
    </div>
    <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
</body>
</html>

