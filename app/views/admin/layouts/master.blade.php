@include('admin.layouts.head')
@include('admin.layouts.header')
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('admin.layouts.sidebar')
            @yield('content')
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="{{asset('admin/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendors/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('admin/vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{asset('admin/vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('admin/js/build/js/custom.min.js')}}"></script>    
    <script src="{{asset('admin/fileupload/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/fileupload/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/fileupload/jquery.fileupload.js')}}"></script>    
    <script src="{{asset('admin/js/common.js')}}"></script>
    @yield('page-script')
</body>
</html>    