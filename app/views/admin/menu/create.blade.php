@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Menu</h3>
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
                        <form role="form" name="frmMenu" id='frmMenu' action="{{route('admin.menu.save')}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Include this in</label>
                                <select name="include_in" id="include_in" class="form-control">
                                    <option value="0">Select Menu</option>
                                    @foreach($parentMenus as $parentMenu)
                                    <option value="{{$parentMenu->id}}" @if(Input::old('include_in') == $parentMenu->id) selected="selected" @endif>{{ucfirst($parentMenu->title)}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Menu Title" name="title" id="title" value="{{Input::old('title')?Input::old('title'):''}}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Menu Description">{{Input::old('description')?Input::old('description'):''}}</textarea>
                            </div>
                            <div class="form-group meta">
                                <label>Meta Title</label>
                                <input class="form-control" placeholder="Meta Title" name="meta_title" id="meta_title" value="{{Input::old('meta_title')?Input::old('meta_title'):''}}">
                            </div>
                            <div class="form-group meta">
                                <label>Meta Keyword</label>
                                <input class="form-control" placeholder="Menu Keyword" name="meta_keyword" id="meta_keyword" value="{{Input::old('meta_keyword')?Input::old('meta_keyword'):''}}">
                            </div>
                            <div class="form-group meta">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description">{{Input::old('meta_description')?Input::old('meta_description'):''}}</textarea>
                            </div>
                            <div class="form-group  meta">
                                <label>Image</label>
                                <input type="file" name="image" id="image" accept="image/*" />
                                <input type="hidden" name="mediatype" id="mediatype" value="image" />
                                <input type="hidden" name="fileName" id="fileName" value="" />
                            </div>
                            <div id="uploadwrapper"></div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('admin.menu.list')}}" class="btn btn-default">Cancel</a>
                                <button name="submit" type="reset" class="btn btn-info">Reset</button>
                                <button name="submit" type="submit" class="btn btn-success">Save</button>
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
<script src="{{asset('admin/js/menu.js')}}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#description',  plugins: "code"});</script>
<script>
    var parentMenus = '{{$parentMenus->count()}}';
    var selected = {{Input::old('include_in') ? Input::old('include_in') : 0}};
    hideElements(selected);
</script>
@endsection
@endsection
