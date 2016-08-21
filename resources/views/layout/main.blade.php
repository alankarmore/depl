<!DOCTYPE html>
<html>
    @include('layout.head')
    <body>
        @include('layout.header')
        @yield('content')
        @include('layout.footer')
        @yield('page-script','')
    </body>
</html>
