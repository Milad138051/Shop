<div class="bg-white mx-5 mb-4 px-3 py-3 border rounded-xl">
    <div>
        <div class="opacity-80 mb-1">
            دسته بندی:
        </div>
      
        <span class="space-y-1 sidebar-nav-item-title">
                <a href="{{route('front.products',['search'=>request()->search ? request()->search : null,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">
                      همه
                </a>
        </span> 
        @foreach ($categories as $category)
        <span class="space-y-1 sidebar-nav-item-title">
                @if($category->products->count() > 0)
                <a href="{{route('front.products',['category'=>$category->id,'search'=>request()->search ? request()->search : null,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">
                      {{$category->name}}
                </a>
                @else  
                <span class="d-inline">
                      {{$category->name}}    
                </span>	      
                @endif	
                @if($category->children->count() > 0)
                <i class="fa fa-angle-left"></i>
                @endif
        </span>     
        @include('front.layouts.partials.products-sidebar-categories-sub-categories',['categories'=>$category->children])       
        @endforeach
    
    </div>
</div>

