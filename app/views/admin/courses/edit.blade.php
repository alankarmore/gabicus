@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Update Course Information</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.courses')}}">Back</a></span>
                <div class="clearfix"></div>
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
                        <form id="addCourse" data-parsley-validate class="form-horizontal form-label-left" action="{{route('admin.courses.update',['id' => $course->id])}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Marked As Popular<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="checkbox" name="popular" id="popular" value="1" @if($course->is_popular == 1) checked="checked" @endif />
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Course Category<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="category" id="category" class="form-control col-md-7 col-xs-12">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($course->category_id == $category->id) selected="selected" @endif >{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="red">{{ $errors->first('category') }}</span>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Course Title<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12" value="{{$course->title}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Location<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="location" id="location" class="form-control col-md-7 col-xs-12" value="{{$course->location}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Fees<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="fees" id="fees"  class="form-control col-md-7 col-xs-12" value="{{$course->fees}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-description">Course Description<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea name="description" id="description" class="form-control col-md-7 col-xs-12" rows="20">{{$course->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Course Image
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="file" name="image" id="image" accept="image/*" />
                                <input type="hidden" name="mediatype" id="mediatype" value="image" />
                                <input type="hidden" name="fileName" id="fileName" value="" />
                            </div>
                            <div id="uploadwrapper"></div>                        
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Previous Image<span class="required">*</span>
                                </label>                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{asset('uploads/course')}}/{{$course->image_name}}" width="100px" height="100px" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{route('admin.categories')}}" class="btn btn-primary">Cancel</a>
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
<!-- /page content -->
@section('page-script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#description',  plugins: "code" });</script>
<script>
 activeParentMenu('courses');
</script>
@endsection
@endsection
