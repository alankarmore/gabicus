@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List of all available Users</h2>
                    <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.user.create')}}">Create Menu</a></span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif                    
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th data-field="first_name" data-sortable="true">First Name</th>
                                <th data-field="last_name" data-sortable="true">Last Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="user_type" data-sortable="true">User Type</th>
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
        var route = "{{route('admin.user.list')}}";
        generateTable('userTable',route,'first_name','asc');
    });
</script>
@endsection
@endsection