@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
<div class="container userprofile">
{{--    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="toplinks">
            <p>You are here :</p>
            <ul>
                <li class="first"><a href="{{route('/')}}">Home</a></li>
                <li >New Question</li>
            </ul>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" id="logout">
            <div class="page-header">
                <h3 class="reviews">Post A Job</h3>
            </div>
        </div>
    </div>
    <div class="row">
        @include('partials.error')
        <div class="col-md-8 col-md-offset-2">
        <form action="{{route('job.create')}}" method="POST" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Job category">Job Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Select Job Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(Input::old('category_id') == $category->id) selected="selected" @endif>{{ucwords($category->category_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Job Title</label>
                            <input class="form-control" placeholder="Job TItle" name="title" id="title" value="{{Input::old('title')?Input::old('title'):''}}">
                        </div>
                        <div class="form-group meta">
                            <span class="pull-left"><label>Experience</label></span>
                                <span class="col-md-4">
                                <select name="from_experience" id="from_experience" class="form-control">
                                    @for($index = 0; $index <= 20; $index++)
                                        <option value="{{$index}}">{{$index}}</option>
                                    @endfor
                                </select>
                                </span>
                            <span class="col-xs-1">To</span>
                                <span class="col-md-4">
                                <select name="to_experience" id="to_experience" class="form-control">
                                    @for($index = 0; $index <= 20; $index++)
                                        <option value="{{$index}}">{{$index}}</option>
                                    @endfor
                                    <option value="+">+</option>
                                </select>
                                </span>
                            <span class="col-xs-1">Years</span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label>Qualification</label>
                            <input class="form-control" placeholder="Qualification" name="qualification" id="qualification" value="{{Input::old('qualification')?Input::old('qualification'):''}}">
                        </div>
                        <div class="form-group">
                            <label>Skills</label>
                            <input class="form-control" placeholder="Skills" name="job_skills" id="job_skills" value="{{Input::old('job_skills')?Input::old('job_skills'):''}}">
                        </div>
                        <div class="form-group">
                            <label for="Question">Location</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Location" value="{{Input::old('location')?Input::old('location'):''}}"/>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description">{{Input::old('description')?Input::old('description'):''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-2 action-row margin-bottom10">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <input type="submit" class="btn btn-block btn-primary text-uppercase" value="Save">
                        </div>
                        <div class="col-sm-5">
                            <a href="{{ route('user.profile.view') }}" class="btn btn-block btn-primary text-uppercase">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection