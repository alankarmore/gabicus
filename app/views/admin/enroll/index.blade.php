@extends('admin.layouts.master')
@section('title', 'Enrollment List')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Enrollments</h2>
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
                                <th>Email</th>
                                <th>Course</th>
                                <th>Qualification</th>
                                <th>Age</th>
                                <th>Experience</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if($enrollments)
                           @foreach($enrollments as $enroll)
                            <tr>
                                <td>{{ucfirst($enroll->name)}}</td>
                                <td>{{$enroll->email}}</td>
                                <td>{{ucfirst($enroll->courseInfo->title)}}</td>
                                <td>{{ucfirst($enroll->qualification)}}</td>
                                <td>{{ucfirst($enroll->age)}} Year/s</td>
                                <td>{{substr(strip_tags($enroll->experience),0,100)}}@if(strlen($enroll->experience) > 100)...@endif</td>
                                <td><a href="{{route('admin.enroll.show',['id' => $enroll->id])}}">Show</a></td>
                            </tr>
                           @endforeach
                           @else
                           <tr><td colspan="2">No records found</td></tr>
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
