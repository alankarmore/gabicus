<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
@yield('page-css')
<body>
@include('layouts.header')
    @yield('content')
@include('layouts.footer')
@yield('page-script','')
</body>
</html>