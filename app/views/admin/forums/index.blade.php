@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List of all available Forums</h2>
                    <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.forums.create')}}">Create Category</a></span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif                    
                    <table id="forumsTable">
                        <thead>
                            <tr>
                                <th data-field="question" data-sortable="true">Question</th>
                                <th data-field="category_name" data-sortable="true">Forum Category Name</th>
                                <th data-field="description" data-sortable="false">Description</th>
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
        var route = "{{route('admin.forums.list')}}";
        generateTable('forumsTable',route,'question','asc');
    });
</script>
@endsection
@endsection