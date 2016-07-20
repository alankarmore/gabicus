@extends('admin.layouts.master')
@section('title', 'Corporate Training Request lists')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Corporate Trainings</h2>
                    <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.courses.create')}}">Create Course</a></span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">List of all corporate training's list .</p>
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Team Count</th>
                                <th>Location</th>
                                <th>Contact Number</th>
                                <th>Courses Required</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if($corporateTrainings)
                           @foreach($corporateTrainings as $corporateTraining)
                            <tr>
                                <td>{{ucfirst($corporateTraining->name)}}</td>
                                <td>{{$corporateTraining->email}}</td>
                                <td>{{$corporateTraining->team_members}}</td>
                                <td>{{ucfirst($corporateTraining->location)}}</td>
                                <td>{{$corporateTraining->contact_number}}</td>
                                <td>{{substr(strip_tags($corporateTraining->courses_required),0,100)}}@if(strlen($corporateTraining->courses_required) > 100)...@endif</td>
                                <td><a href="{{route('admin.enroll.show',['id' => $corporateTraining->id])}}">Show</a></td>
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
