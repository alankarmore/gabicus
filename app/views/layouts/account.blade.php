<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
    <body>
        @include('layouts.header')
        @yield('content')
        <!-- Feedback Section End -->
        @include('layouts.footer')
        @yield('page-script','')
    </body>
</html>