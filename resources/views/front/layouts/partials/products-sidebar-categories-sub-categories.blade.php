
       <section class="sidebar-nav-sub-wrapper py-1 px-2">
        <section class="sidebar-nav-sub-item">
            @foreach ($categories as $category)
            <span class="space-y-1 sidebar-nav-sub-item-title">
                <a href="{{route('front.products',['category'=>$category->id,'search'=>request()->search ? request()->search : null,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">
                      {{$category->name}}
                </a>
                @if($category->children->count() > 0)
                <i class="fa fa-angle-left"></i>
                @endif
        </span>     
        @include('front.layouts.partials.products-sidebar-categories-sub-categories', ['categories' => $category->children])
        @endforeach


        
            </section>
    
    </section>