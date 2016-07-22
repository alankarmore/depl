<!DOCTYPE html>
<html>
    @include('admin.layout.head')
    <body>
        @include('admin.layout.header')
        @include('admin.layout.sidebar')
        @yield('content')
        @include('admin.layout.footer')
        @yield('page-script','')
    </body>
</html>
