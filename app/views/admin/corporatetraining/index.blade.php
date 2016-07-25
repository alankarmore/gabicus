@extends('admin.layouts.master')
@section('title', 'Corporate Training Request lists')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List of all corporate training's list .</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif
                    <table id="corporateTraining" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="team_members" data-sortable="true">Team Count</th>
                                <th data-field="location" data-sortable="true">Location</th>
                                <th data-field="contact_number" data-sortable="true">Contact Number</th>
                                <th data-field="courses_required" data-sortable="true">Courses Required</th>
                                <th data-field="action" data-sortable="false">Action</th>                                         
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@section('page-script')
<link href="{{asset('admin/css/bootstrap-table.css')}}" rel="stylesheet">
<script src="{{asset('admin/js/bootstrap-table.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var route = "{{route('admin.corporatetraining')}}";
        generateTable('corporateTraining',route,'id','desc');
    });
</script>
@endsection
@endsection
