<div class="col-md-3 col-sm-4 col-xs-12">
    <div class="row">
        <div class="category-filter">
            <h3 class="h3 margin-bottom10">Categories</h3>
            <div class="category-list-block margin-bottom10 padding-bottom10">
                @if($categories)
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="javascript:void(0);" class="sort-cat" data-cat="{{$category->slug}}">{{ucwords($category->category_name)}}</a> <span class="text-right">{{$category->cnt}}</span></li>
                        @endforeach
                    </ul>
                @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>