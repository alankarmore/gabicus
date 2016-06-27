@extends('admin.layouts.master')
@section('title', 'Edit Alumni')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Alumni</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
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
                        <form id="addAlumni" data-parsley-validate class="form-horizontal form-label-left" action="{{route('admin.alumnies.update',array('id' => $alumni->id))}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Person Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="person_name" id="person_name"  class="form-control col-md-7 col-xs-12" value="{{$alumni->person_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-description">Description<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="alerts"></div>
                                    <textarea name="description" id="description" class="form-control col-md-7 col-xs-12">{{$alumni->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Person Image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image_name" id="image_name"  class="">
                                </div>                            
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Previous Image<span class="required">*</span>
                                </label>                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{asset('uploads/alumni')}}/{{$alumni->image_name}}" width="100px" height="100px" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{route('admin.alumnies')}}" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
