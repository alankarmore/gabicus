@extends('layouts.main')
@section('title', "$metaTitle")@endsection
@section('page-css')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row container">
        <div class="col-md-4">
            <div class="col-md-4">
                <div><a href="javascript:void(0);">All Questioned</a></div>
                <div><a href="javascript:void(0);">Not Answered</a></div>
                <div><a href="javascript:void(0);">Suggested</a></div>
            </div>
        </div>
        <div class="col-sm-8">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Office</th>
                    <th>Comments</th>
                    <th>Posted By</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Office</th>
                    <th>Comments</th>
                    <th>Posted By</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('page-script')
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var x = "{{route('forum.list.data')}}";
            $('#example').DataTable( {
                "ajax": x,
            } );
        } );
    </script>
@endsection