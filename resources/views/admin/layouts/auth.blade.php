<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ adminAsset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap-float-label.min.css') }}" />
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
</head>

<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        @yield('content')
    </main>
    <script src="{{ adminAsset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ adminAsset('js/dore.script.js') }}"></script>
    <script src="{{ adminAsset('js/scripts.js') }}"></script>
    @yield('footer')



</body>

</html>
