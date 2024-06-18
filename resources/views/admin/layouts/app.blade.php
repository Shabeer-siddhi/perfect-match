<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ adminAsset('font/iconsmind-s/css/iconsminds.css') }}" />


    <link rel="stylesheet" href="{{ adminAsset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('font/simple-line-icons/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap.rtl.only.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/fullcalendar.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/dataTables.bootstrap4.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/datatables.responsive.bootstrap4.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/select2.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/perfect-scrollbar.css') }}" />
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/glide.core.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap-stars.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/nouislider.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap-datepicker3.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/component-custom-switch.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/main.css') }}" />

    @yield('header')
    <script src="{{ adminAsset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        var config = {
            routes: {
                css_path: "{{ adminAsset('') }}",
            }
        };
    </script>

    @livewireStyles
</head>

<body id="app-container" class="{{ $body_class ?? 'show-spinner menu-sub-hidden' }}">
    @include('admin.parts.nav')
    @include('admin.parts.menu')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-status />
                    <x-errors-status />
                </div>
            </div>
        </div>
        @yield('content')
    </main>
    @include('admin.parts.footer')

    <script src="{{ adminAsset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ adminAsset('js/vendor/Chart.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/chartjs-plugin-datalabels.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/fullcalendar.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/datatables.min.js') }}"></script> --}}
    <script src="{{ adminAsset('js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ adminAsset('js/vendor/progressbar.min.js') }}"></script>
    {{-- <script src="{{ adminAsset('js/vendor/jquery.barrating.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/select2.full.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/nouislider.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/bootstrap-datepicker.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/Sortable.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/mousetrap.min.js') }}"></script> --}}
    {{-- <script src="{{ adminAsset('js/vendor/glide.min.js') }}"></script> --}}


    @yield('footer')
    @stack('scripts')

    <script src="{{ adminAsset('js/dore.script.js') }}"></script>
    <script src="{{ adminAsset('js/scripts.js') }}"></script>

    @livewireScripts
</body>

</html>
