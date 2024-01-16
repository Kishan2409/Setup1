<!DOCTYPE html>

<html lang="en">

<head>
    @include('admin.files.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed" style=" overflow-x: hidden;">

    <div class="wrapper">

        {{-- helper --}}
        @php
            $setting = Helper::Settings();
        @endphp

        {{-- favicon --}}
        @if (!empty($setting->favicon))
            <div hidden>
                <p id="icon">{{ asset('public/storage/favicon/' . $setting->favicon) }}</p>
            </div>
        @endif

        {{-- navbar --}}
        @include('admin.files.navbar')

        {{-- sidebar --}}
        @include('admin.files.sidebar')

        {{-- maincontent --}}
        @yield('main')

        {{-- footer --}}
        @include('admin.files.footer')

    </div>

    {{-- script --}}
    @include('admin.files.script')

    {{-- blade file script --}}
    @yield('script')

    {{-- set fevicon script --}}
    <script>
        $(document).ready(function() {
            var favicon = $("#icon").text();
            $("#favicon").attr("href", favicon);
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>

</body>

</html>
