@extends('layouts.main')
@section('title', "$metaTitle")@endsection
@section('page-css')
    <link href="{{asset('assets/css/forum.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!--------------------- Main Content ------------------->
    <div class="container">
{{--        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="toplinks">
                <p>You are here :</p>
                <ul>
                    <li class="first"><a href="{{route('/')}}">Home</a></li>
                    <li >Forum List</li>
                </ul>
            </div>
        </div>--}}
        <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom20 nopadding-right margin-top20">
            @include('user.forum.sorting')
            <div class="col-md-9 nopadding-right">
                <div class="categories-details">
{{--                    <h3 class="categories-heading text-uppercase nomargin">{{ucwords($category->name)}}</h3>
                    <p class="categories-para margin-top5">{{$category->description}}</p>--}}
                    @if($forums->getTotal())
                        <div class="col-md-12 margin-top10 margin-bottom10 nopadding">
                            <div class="result nomargin-right">
                                <div class="col-md-4 text-left">
                                    <span>{{$forums->getTotal()}} Results (Page {{$forums->getCurrentPage()}} of {{$forums->getLastPage()}})</span>
                                </div>
                                <div class="col-md-4 text-center">
                                    Page Size :
                                    <select class="page-size" name="pageSize" id="pageSize">
                                        <option value="10" @if(Input::get('pagesize') == 10) selected="selected" @endif>10</option>
                                        <option value="20" @if(Input::get('pagesize') == 20) selected="selected" @endif>20</option>
                                        <option value="40" @if(Input::get('pagesize') == 40) selected="selected" @endif>40</option>
                                        <option value="60" @if(Input::get('pagesize') == 60) selected="selected" @endif>60</option>
                                    </select>
                                </div>
                                <div class="col-md-4 text-right">
                                    Sort By :
                                    <select name="sortBy" id="sortBy">
                                        <option value="latest" @if(Input::get('sort') == 'latest') selected="selected" @endif>Latest</option>
                                        <option value="oldest" @if(Input::get('sort') == 'oldest') selected="selected" @endif>Oldest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach($forums as $index => $forum)
                            <div class="col-md-12 category-list margin-bottom10 @if($index > 1 && $index%2 != 0 || $index == 1) list-alternate @endif padding-bottom10">
                                <a href="{{route('forum.view',array('id'=>$forum->id))}}">
                                    <h4 class="list-heading">{{substr($forum->question,0,80)}}...</h4>
                                </a>
                                <p class="border-bottom">{{substr($forum->description,0,246)}}...</p>
                                <span class="category-date-para"> By <strong>{{ucwords($forum->user->first_name." ".$forum->user->last_name)}}</strong> | {{$forum->created_at->toDayDateTimeString()}} | {{$forum->answers->count()}} Answers</span>
                            </div>
                        @endforeach
                        <div>
                            {{$forums->links()}}
                        </div>
                    @else
                        @if(Auth::user())
                            <div class="alert alert-warning">Be the first one to <a href="{{route('forum.create')}}">post a question</a>  under this category.</div>
                        @else
                            <div class="alert alert-warning">No Questions found. You need to be <a href="{{route('user.signin')}}">Login </a> or <a href="{{route('user.signup')}}">Sign Up</a> to post a question</div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
        <input type="hidden" id="cat" name="cat" value="{{Input::get('cat')?Input::get('cat'):""}}" />
    </div>
    <!--------------------- End Main Content ----------------------------------->
@section('page-script')
    <script type="text/javascript">
        var page = 1;
        var sorting = '{{$sort}}';
        var cat = '{{$cat}}';
        var pageSize = '{{$limit}}';
        $(function(){
            $(document).on('click',".sort-cat",function(){
                cat = $(this).attr('data-cat');
                redirect();
            });

            $(document).on('change',"#sortBy",function(){
                sorting = $(this).val();
                redirect();
            });

            $(document).on('change',"#pageSize",function(){
                pageSize = $(this).val();
                page = 1;
                redirect();
            });

            $(document).on('click',"ul.pagination li a",function(e){
                e.preventDefault();
                var pageNumber = $(this).attr('href').split('?page=',2);
                page = parseInt(pageNumber[1]);
                redirect();
            });
        });

        function redirect(){
            console.log(sorting);
            var route = '{{route('forum.list')}}';
            route +="?cat="+cat+"&sort="+sorting+"&pagesize="+pageSize+"&page="+page;
            window.location.href = route;
        }
    </script>
@endsection
@endsection