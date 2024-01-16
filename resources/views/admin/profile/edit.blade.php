@extends('admin.files.layouts')
@section('title', $module_name)
@section('main')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $module_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                    class="text-decoration-none text-dark"><i class="fa-solid fa-gauge"></i>
                                    Home</a></li>
                            <li class="breadcrumb-item active">{{ $module_name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active h4" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-four-profile" role="tab"
                                            aria-controls="custom-tabs-four-profile" aria-selected="true">
                                            <i class="fa-solid fa-key"></i> Update Password
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link h4" id="custom-tabs-four-setting-tab" data-toggle="pill"
                                            href="#custom-tabs-four-setting" role="tab"
                                            aria-controls="custom-tabs-four-setting" aria-selected="false"><i
                                                class="fa-solid fa-earth-asia"></i> Web Settings</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">

                                        <p class="mt-1 h4">
                                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                        </p>

                                        <form method="post" id="pass" action="{{ route('password.update') }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row ">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="current_password">Current Password <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input id="current_password" name="current_password"
                                                                    type="password" class="form-control"
                                                                    autocomplete="current-password"
                                                                    placeholder="Enter Current Password"
                                                                    oncopy="return disableCopy();"
                                                                    onpaste="return disablePaste();"
                                                                    oncut="return disableCut();"
                                                                    oncontextmenu="return disableContextMenu();">
                                                                <span class="input-group-append">
                                                                    <button tabindex="-1" type="button"
                                                                        id="Current_Password_Btn"
                                                                        class="btn btn-info btn-flat"><i id="cur_btn"
                                                                            class="fa-solid fa-lock"></i></button>
                                                                </span>
                                                                <div class="col-12"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label for="password">New Password <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input id="password" name="password" type="password"
                                                                    class="form-control" autocomplete="new-password"
                                                                    placeholder="Enter New Password"
                                                                    oncopy="return disableCopy();"
                                                                    onpaste="return disablePaste();"
                                                                    oncut="return disableCut();"
                                                                    oncontextmenu="return disableContextMenu();">
                                                                <span class="input-group-append">
                                                                    <button tabindex="-1" type="button" id="password_btn"
                                                                        class="btn btn-info btn-flat"><i id="pass_btn"
                                                                            class="fa-solid fa-lock"></i></button>
                                                                </span>
                                                                <div class="col-12"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-2">
                                                            <label for="password_confirmation">Confirm Password <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input id="password_confirmation"
                                                                    name="password_confirmation" type="password"
                                                                    class="form-control" autocomplete="new-password"
                                                                    placeholder="Enter Confirm Password"
                                                                    oncopy="return disableCopy();"
                                                                    onpaste="return disablePaste();"
                                                                    oncut="return disableCut();"
                                                                    oncontextmenu="return disableContextMenu();">
                                                                <span class="input-group-append">
                                                                    <button tabindex="-1" type="button"
                                                                        id="password_confirmation_btn"
                                                                        class="btn btn-info btn-flat"><i id="pass_con_btn"
                                                                            class="fa-solid fa-lock"></i></button>
                                                                </span>
                                                                <div class="col-12"></div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <hr>
                                                            <button class="btn btn-success mr-2" type="submit"><i
                                                                    class="fa-solid fa-file-pen"></i>
                                                                Update
                                                            </button>
                                                            <a class="btn btn-danger" href="{{ route('dashboard') }}"><i
                                                                    class="fa-solid fa-xmark"></i> Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-setting" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-setting-tab">
                                        <form method="post" action="{{ route('setting.store') }}"
                                            enctype="multipart/form-data"
                                            @if (!empty($setting->title)) id="webupdate" @else id="webadd" @endif>
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="title">Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title" id="title"
                                                        class="form-control" placeholder="Enter web title"
                                                        @if (!empty($setting->title)) value="{{ $setting->title }}" @endif>
                                                </div>
                                                <div class="col-md-3 mt-2 ">
                                                    <label for="logo">Logo
                                                        @if (!empty($setting->title))
                                                        @else
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" name="logo" class="custom-file-input"
                                                            id="logo">
                                                        <label class="custom-file-label" for="logo">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-2 ">
                                                    @if (!empty($setting->logo))
                                                        <center>
                                                            <img src="{{ asset('public/storage/logo/' . $setting->logo) }}"
                                                                width="100" height="100">
                                                        </center>
                                                    @endif
                                                </div>
                                                <div class="col-md-3  mt-2">
                                                    <label for="favicons">Favicon
                                                        @if (!empty($setting->title))
                                                        @else
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" name="favicon" class="custom-file-input"
                                                            id="favicons">
                                                        <label class="custom-file-label" for="favicons">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-2 ">
                                                    @if (!empty($setting->logo))
                                                        <center>
                                                            <img src="{{ asset('public/storage/favicon/' . $setting->favicon) }}"
                                                                width="100" height="100">
                                                        </center>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <hr>

                                                    <button class="btn btn-success mr-2 " type="submit" name="submit">
                                                        <i class="fa-solid fa-file-pen"></i> Update</button>
                                                    <a href="{{ route('dashboard') }}" class="btn btn-danger "><i
                                                            class="fa-solid fa-xmark"></i> Cancel</a>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{-- success alert --}}
    @if (session('status'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('status') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: '<i class="fa-regular fa-thumbs-up"></i> Great!',
            });
        </script>
    @endif
    {{-- error alert --}}
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ Session::get('error') }}",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
        </script>
    @endif
    {{-- setting update --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: 'Ok  <i class="fa-regular fa-thumbs-up"></i>',
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {

            // password form validation
            $('#pass').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    }
                },
                messages: {
                    current_password: {
                        required: "Current password is required.",
                        minlength: "Please enter at least 8 characters."
                    },
                    password: {
                        required: "New password is required.",
                        minlength: "Please enter at least 8 characters."
                    },
                    password_confirmation: {
                        required: "Confirm password is required.",
                        minlength: "Please enter at least 8 characters.",
                        equalTo: "Confirm password is not same as password."
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

            // websetting add form validation
            $('#webadd').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    logo: {
                        required: true,
                        extension: "jpeg|png|jpg"
                    },
                    favicon: {
                        required: true,
                        extension: "jpeg|png|jpg"
                    },
                },
                messages: {
                    title: {
                        required: "Title is required.",
                    },
                    logo: {
                        required: "Logo is required.",
                        extension: "Please enter a value with a valid extension like jpeg|png|jpg."
                    },
                    favicon: {
                        required: "Favicon is required.",
                        extension: "Please enter a value with a valid extension like jpeg|png|jpg."
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                submitHandler: function(form) {
                    $(':button[name="submit"]').prop('disabled', true);
                    form.submit();
                }
            });

            // websetting update form validation
            $('#webupdate').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    logo: {
                        extension: "jpeg|png|jpg"
                    },
                    favicon: {
                        extension: "jpeg|png|jpg"
                    },
                },
                messages: {
                    title: {
                        required: "Title is required.",
                    },
                    logo: {

                        extension: "Please enter a value with a valid extension like jpeg|png|jpg."
                    },
                    favicon: {

                        extension: "Please enter a value with a valid extension like jpeg|png|jpg."
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                submitHandler: function(form) {
                    $(':button[name="submit"]').prop('disabled', true);
                    form.submit();
                }
            });

            // bootstrap tabnav selected default
            $('#custom-tabs-four-tab a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // store the currently selected tab in the hash value
            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
                var id = $(e.target).attr("href").substr(1);
                window.location.hash = id;
            });

            // on load of the page: switch to the currently selected tab
            var hash = window.location.hash;
            $('#custom-tabs-four-tab a[href="' + hash + '"]').tab('show');

            //current_password_eye_btn for view enter password
            $("#Current_Password_Btn").click(function(e) {
                e.preventDefault();
                var input = $("#current_password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#cur_btn').removeClass('fa-solid fa-lock');
                    $('#cur_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#cur_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#cur_btn').addClass('fa-solid fa-lock');
                }
            });

            //password_eye_btn for view enter password
            $("#password_btn").click(function(e) {
                e.preventDefault();
                var input = $("#password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#pass_btn').removeClass('fa-solid fa-lock');
                    $('#pass_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#pass_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#pass_btn').addClass('fa-solid fa-lock');
                }
            });

            //password_confirmation_eye_btn for view enter password
            $("#password_confirmation_btn").click(function(e) {
                e.preventDefault();
                var input = $("#password_confirmation");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#pass_con_btn').removeClass('fa-solid fa-lock');
                    $('#pass_con_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#pass_con_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#pass_con_btn').addClass('fa-solid fa-lock');
                }
            });
        });
    </script>
    <script language="javascript" type="text/javascript">
        function disableCopy() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Copy.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
            return false;
        }

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

        function disableCut() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Cut.",
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
@endsection
