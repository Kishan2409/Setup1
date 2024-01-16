<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <link id="favicon" rel="shortcut icon" type="image/png" href="" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">
    @php
        $setting = Helper::Settings();
    @endphp
    @if (!empty($setting->favicon))
        <div hidden>
            <p id="icon">{{ asset('public/storage/favicon/' . $setting->favicon) }}</p>
        </div>
    @endif
    <div class="login-box ">
        @if (!empty($setting->title))
            <div class="login-logo">
                <a href="{{ route('login') }}"><b
                        style="color:#dd5a43 !important;font-size: 45px;font-family: Algerian">{{ $setting->title }}</b></a>
            </div>
        @endif
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please Enter Your Information</p>

                <form method="POST" action="{{ route('login') }}" id="login" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control email"
                                placeholder="Email" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @error('email')
                                    <strong style="color: red;"> {{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control password"
                                placeholder="Password" onpaste="return disablePaste();"
                                oncontextmenu="return disableContextMenu();">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-info btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{--
      <p class="mb-1">
        <a href="{{route('password.email')}}">I forgot my password</a>
      </p> --}}
                <p class="mb-1">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('public/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('public/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
    <script>
        var favicon = $("#icon").text();
        $("#favicon").attr("href", favicon);
    </script>
    <script>
        $(document).ready(function() {
            $('#login').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    }
                },
                messages: {
                    email: {
                        required: "Email is required.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Password is required.",
                        minlength: "Please enter at least 8 characters."
                    }
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                submitHandler: function(form) {
                    $(':button[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
    <script language="javascript" type="text/javascript">
        function disablePaste() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Paste.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
            return false;
        }

        function disableContextMenu() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform right click via mouse as well as keyboard.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });

            return false;
        }
    </script>
</body>

</html>
