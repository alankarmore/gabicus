@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" id="logout">
            <div class="page-header">
                <h3 class="reviews">Post your Question</h3>
            </div>
        </div>
    </div>
    <div class="row">
        @include('partials.error')
        <div class="col-md-8 col-md-offset-2">
            <form action="{{route('forum.create')}}" method="POST" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="forum category">Forum Category</label>
                            <select class="form-control" id="forum_category" name="forum_category">
                                <option>Select Forum Category</option>
                                @foreach($forumCategories as $category)
                                    <option value="{{$category->id}}">{{ucwords($category->category_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Question">Question</label>
                            <input type="text" name="question" id="question" class="form-control" placeholder="Question" required=""/>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description" required=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-2 action-row">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <input type="submit" class="btn btn-block btn-primary text-uppercase" value="Save">
                        </div>
                        <div class="col-sm-5">
                            <a href="{{ URL::previous()}}" class="btn btn-block btn-primary text-uppercase">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection