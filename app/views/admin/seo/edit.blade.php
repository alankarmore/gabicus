@extends('admin.layouts.master')
@section('title', 'Update menu information')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update SEO information</h3>
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
                            <form role="form" name="frmSeo" id='frmSeo' action="{{route('admin.seo.update',array('id' => !empty($seo->id) ? $seo->id : 0 ))}}" method="POST" enctype="multipart/form-data">
                                <div class="form-group meta">
                                    <label>Meta Title</label>
                                    <input class="form-control" placeholder="Meta Title" name="meta_title" id="meta_title" value="{{ !empty($seo->meta_title) ? $seo->meta_title : "" }}">
                                </div>
                                <div class="form-group meta">
                                    <label>Meta Keyword</label>
                                    <input class="form-control" placeholder="Menu Keyword" name="meta_keyword" id="meta_keyword" value="{{!empty($seo->meta_keyword) ? $seo->meta_keyword : ""}}">
                                </div>
                                <div class="form-group meta">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description">{{!empty($seo->meta_description) ? $seo->meta_description : ""}}</textarea>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
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
@endsection