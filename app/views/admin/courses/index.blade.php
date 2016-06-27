@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Courses</h2>
                    <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.courses.create')}}">Create Course</a></span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">List of all available courses.</p>
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if($courses)
                           @foreach($courses as $course)
                            <tr>
                                <td>{{ucfirst($course->title)}}</td>
                                <td>{{substr(strip_tags($course->description),0,100)}}@if(strlen($course->description) > 100)...@endif</td>
                                <td><a href="{{route('admin.courses.edit',['id' => $course->id])}}">Edit</a> | 
                                    <a href="{{route('admin.courses.show',['id' => $course->id])}}">Show</a> |
                                    <a href="{{route('admin.courses.delete',['id' => $course->id])}}"
                                       onclick="javascript:return confirm('Are you sure ?')">Delete</a></td>
                            </tr>
                           @endforeach
                           @else
                           <tr><td colspan="2"><a href="{{route('admin.courses.create')}}">Click</a> to add first Course</td></tr>
                           @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@section('page-script')
<link href="{{asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
$(function () {
    $('#datatable').dataTable();
});
</script>
@endsection
@endsection
