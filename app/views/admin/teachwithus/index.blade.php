@extends('admin.layouts.master')
@section('title', 'Teach with us records lists')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Teach with us</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">List of all interested candidates who wish to teach with us .</p>
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Qualification</th>
                                <th>Age</th>
                                <th>Location</th>
                                <th>Contact Number</th>
                                <th>IT Experience</th>
                                <th>Training Courses</th>
                                <th>Resume</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if($teachwithus)
                           @foreach($teachwithus as $candidate)
                            <tr>
                                <td>{{ucfirst($candidate->name)}}</td>
                                <td>{{$candidate->email}}</td>
                                <td>{{ucfirst($candidate->qualification)}}</td>
                                <td>{{$candidate->age}} Year/s</td>
                                <td>{{ucfirst($candidate->location)}}</td>
                                <td>{{$candidate->contact_number}}</td>
                                <td>{{substr(strip_tags($candidate->itexperience),0,100)}}@if(strlen($candidate->itexperience) > 100)...@endif</td>
                                <td>{{substr(strip_tags($candidate->training_courses),0,100)}}@if(strlen($candidate->training_courses) > 100)...@endif</td>
                                <td><a href="{{route('file.download',array('file' => $candidate->resume))}}">Download</a></td>
                                <td><a href="{{route('admin.teachwithus.show',['id' => $candidate->id])}}">Show</a></td>
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
