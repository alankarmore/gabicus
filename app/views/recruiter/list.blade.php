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
            <div class="col-md-9 nopadding-right">
                <div class="categories-details">
{{--                    <h3 class="categories-heading text-uppercase nomargin">{{ucwords($category->name)}}</h3>
                    <p class="categories-para margin-top5">{{$category->description}}</p>--}}
                    @if($jobs->getTotal())
                        <div class="col-md-12 margin-top10 margin-bottom10 nopadding">
                            <div class="result nomargin-right">
                                <div class="col-md-4 text-left">
                                    <span>{{$jobs->getTotal()}} Results (Page {{$jobs->getCurrentPage()}} of {{$jobs->getLastPage()}})</span>
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
                        @foreach($jobs as $index => $job)
                            <div class="col-md-12 category-list margin-bottom10 @if($index > 1 && $index%2 != 0 || $index == 1) list-alternate @endif padding-bottom10">
                                <a href="{{route('jobs.view',array('id'=>$job->id))}}">
                                    <h4 class="list-heading">{{substr($job->title,0,80)}}...</h4>
                                </a>
                                <p class="border-bottom">{{substr($job->description,0,246)}}...</p>
                                <span class="category-date-para"> By <strong>{{ucwords($job->recruiter->first_name." ".$job->recruiter->last_name)}}</strong> | Posted On:{{$job->created_at->toDayDateTimeString()}}</span>
                            </div>
                        @endforeach
                        <div>
                            {{$jobs->links()}}
                        </div>
                    @else
                        <div class="alert alert-warning">No Jobs found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--------------------- End Main Content ----------------------------------->
@section('page-script')
    <script type="text/javascript">
        var page = 1;
        var sorting = '{{$sort}}';
        var pageSize = '{{$limit}}';
        $(function(){

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
            var route = '{{route('myjobs.list')}}';
            route +="?sort="+sorting+"&pagesize="+pageSize+"&page="+page;
            window.location.href = route;
        }
    </script>
@endsection
@endsection