@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container">
        <div class="row">
            @include('partials.error')
            <div class="col-md-8 col-md-offset-2">
                <div>
                    <div class="login_wrapper">
                        <div id="" class="form">
                            <section class="login_content">
                                <form action="{{url('forum/create')}}" method="POST" role="form">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <h1>Add New Question</h1>
                                    <div class="form-group">
                                        <input type="text" name="question" class="form-control" placeholder="Question" required=""/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" rows="5" placeholder="Description" required=""></textarea>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary submit" type="submit">Create</button>
                                        <a href="{{ URL::previous() }}" ><input type="button" class="btn btn-danger btn-circle text-uppercase" value="Cancel"></a>
                                    </div>

                                    <div class="clearfix"></div>

                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection