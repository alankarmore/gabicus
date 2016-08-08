@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Course</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="addCourse" data-parsley-validate class="form-horizontal form-label-left" action="{{route('admin.courses.save')}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Marked As Popular 
                                    <input type="checkbox" name="popular" id="popular" value="1" />
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Course Category<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="category" id="category" class="form-control col-md-7 col-xs-12">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(Input::old('category') && Input::old('category') == $category->id) selected="selected" @endif >{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="red">{{ $errors->first('category') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Course Title<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="title" id="title"  class="form-control col-md-7 col-xs-12" value="{{Input::old('title')? Input::old('title'): '' }}">
                                    <span class="red">{{ $errors->first('title') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Location<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="location" id="location" class="form-control col-md-7 col-xs-12" value="{{Input::old('location')? Input::old('location'): '' }}" />
                                    <span class="red">{{ $errors->first('location') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Fees<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="fees" id="fees"  class="form-control col-md-7 col-xs-12" value="{{Input::old('fees')? Input::old('fees'): '' }}" />
                                    <span class="red">{{ $errors->first('fees') }}</span>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-description">Course Description<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea name="description" id="description" class="form-control col-md-7 col-xs-12" rows="20">{{Input::old('description')? Input::old('description'): ''}}</textarea>
                                    <span class="red">{{ $errors->first('description') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Course Image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" id="image"  class="">
                                    <span class="red">{{ $errors->first('course_image') }}</span>
                                    <input type="hidden" name="mediatype" id="mediatype" value="image" />
                                    <input type="hidden" name="fileName" id="fileName" value="" />
                                </div>                          
                            </div>   
                            <div id="uploadwrapper"></div>
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
<script>tinymce.init({ selector:'#description',  plugins: "code"});</script>
<script>
 activeParentMenu('courses');
</script>
@endsection
@endsection
