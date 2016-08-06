@extends('admin.layouts.master')
@section('title', 'Menu Description')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Menu Information</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.menu.list')}}">Back</a></span>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif                        
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif                        
                        <br />
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Include In</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{(!empty($menu->includedIn) && $menu->includedIn->title)?$menu->includedIn->title:'Nothing'}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Title</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$menu->title}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Description</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$menu->description}}</span></div>
                            </div>
                            @if(!empty($menu->include_in))
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Meta Title</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$menu->meta_title}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Meta Keywords</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$menu->meta_keywords}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Meta Description</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$menu->meta_description}}</span></div>
                            </div>
                            @endif
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Image</label>                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{asset('uploads/menu')}}/{{$menu->image_name}}" width="100px" height="100px" />
                                </div>
                            </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@section('page-script')
<script>
    activeParentMenu('menus'); 
</script>
@endsection
@endsection
