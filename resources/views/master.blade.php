<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Worldcraft E-Commerce</title>
    @include('layouts.custom_style')
    @yield('links')
</head>
<body>
    @include('layouts.navbar')
    @include('layouts.navbar_mobile')
    @include('layouts.off_canvas')


        @yield('index')
        @yield('content')

        @yield('about')

        @yield('contact')

    @include('layouts.footer')

    @yield('modal')

@include('layouts.script')
@yield('script')
</body>
</html>
