<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                {{-- content setion --}}
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                   
                    @if((auth()->user()->hasRole('super-admin','content-admin')) or (auth()->user()->can('show-post') or auth()->user()->can('show-postComment') or auth()->user()->can('show-faq') or auth()->user()->can('show-postCategory') ))
                    <li class="nav-header">محتوا</li>
                    @endif

                    @if (auth()->user()->can('show-faq'))
                    <li class="nav-item">
                        <a href="{{ route('admin.content.faq.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>سوالات متداول</p>
                        </a>
                    </li>                        
                    @endif

            
                    <li class="nav-item has-treeview">

                        @if (auth()->user()->can('show-post') or auth()->user()->can('show-postComment') or auth()->user()->can('show-postComment'))
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-envelope-o"></i>
                            <p>
                                بلاگ
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        @endif

                        <ul class="nav nav-treeview">

                            @if (auth()->user()->can('show-post'))
                            <li class="nav-item">
                                <a href="{{ route('admin.content.post.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پست ها</p>
                                </a>
                            </li>                                
                            @endif

                            @if (auth()->user()->can('show-postCategory'))
                            <li class="nav-item">
                                <a href="{{ route('admin.content.postCategory.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دسته بندی ها</p>
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->can('show-postComment'))
                            <li class="nav-item">
                                <a href="{{ route('admin.content.comment.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>نظرات</p>
                                </a>
                            </li>                                
                            @endif

                        </ul>
                    </li>
                </ul>



                {{-- market section --}}
                {{-- @if(auth()->user()->hasRole('super-admin','market-admin')) --}}
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    @if((auth()->user()->hasRole('super-admin','market-admin')) or (auth()->user()->can('show-amazingSale') or auth()->user()->can('show-banner') or auth()->user()->can('show-brand') or auth()->user()->can('show-commonDiscount') or auth()->user()->can('show-copan') or auth()->user()->can('show-commonDiscount') or auth()->user()->can('show-commonDiscount') or auth()->user()->can('show-delivery') or auth()->user()->can('show-product') or auth()->user()->can('show-productCategory') or auth()->user()->can('show-productComment') or auth()->user()->can('show-property') or auth()->user()->can('order-show') or auth()->user()->can('show-questionAnswer') or auth()->user()->can('store-show') or auth()->user()->can('payment-show') ))
                    <li class="nav-header">فروشگاه</li>
                    @endif

                    <li class="nav-item has-treeview">
                        @if (auth()->user()->can('show-productCategory') or auth()->user()->can('show-brand') or auth()->user()->can('show-product') or auth()->user()->can('show-property') or auth()->user()->can('show-productComment') or auth()->user()->can('show-questionAnswer') or auth()->user()->can('show-delivery') or auth()->user()->can('show-banner') or auth()->user()->can('store-show'))
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tree"></i>
                            <p>
                                ویترین
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        @endif

                        {{-- //vitrin --}}
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->can('show-productCategory'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.category.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دسته بندی</p>
                                </a>
                            </li>                                
                            @endcan


                            @if (auth()->user()->can('show-brand'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.brand.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>برند ها</p>
                                </a>
                            </li>                                
                            @endcan


                            @if (auth()->user()->can('show-product'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.product.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>کالاها</p>
                                </a>
                            </li>                                
                            @endcan


                            @if (auth()->user()->can('show-property'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.property.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>فرم کالا</p>
                                </a>
                            </li>                                
                            @endcan


                            @if (auth()->user()->can('show-productComment'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.comment.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>نظرات</p>
                                </a>
                            </li>                                
                            @endcan

                            @if (auth()->user()->can('show-questionAnswer'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.question-answer.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پرسش و پاسخ</p>
                                </a>
                            </li>                                
                            @endcan

                            @if (auth()->user()->can('show-delivery'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.delivery.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>روش ارسال</p>
                                </a>
                            </li>
                            @endcan

                            @if (auth()->user()->can('show-banner'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.banner.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>بنرها</p>
                                </a>
                            </li>                               
                            @endcan
 
                            @if (auth()->user()->can('store-show'))
                            <li class="nav-item">
                                <a href="{{ route('admin.market.store.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>انبار</p>
                                </a>
                            </li>                                
                            @endcan

                        </ul>
                    </li>
                </ul>

                {{-- //discounts --}}
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">

                            @if (auth()->user()->can('show-commonDiscount') or auth()->user()->can('show-amazingSale') or auth()->user()->can('show-copan'))
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>
                                    تخفیف ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            @endif

                            <ul class="nav nav-treeview">
                                @if (auth()->user()->can('show-copan'))
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.copan')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>کد تخفیف</p>
                                    </a>
                                </li>
                                @endif

                                @if (auth()->user()->can('show-commonDiscount'))
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.commonDiscount')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تخفیف عمومی</p>
                                    </a>
                                </li>
                                @endif

                                @if (auth()->user()->can('show-amazingSale'))
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.amazingSale')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>فروش شگفت انگیز</p>
                                    </a>
                                </li>
                                @endif

                            </ul>
                    </ul>


                    {{-- //payments --}}
                    @if (auth()->user()->can('show-payment'))
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">

                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-success"></i>
                                <p>
                                    پرداخت ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.market.payment.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تمام پرداخت ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.payment.online')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پرداخت انلاین</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.payment.cash')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پرداخت در محل</p>
                                    </a>
                                </li>
                            </ul>
                    </ul>
                    @endif

                    {{-- //orders --}}
                    @if (auth()->user()->can('order-show'))
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>
                                سفارشات
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.all')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تمام سفارشات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.newOrders')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>جدید</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.sending')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>در حال ارسال</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.unpaid')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پرداخت نشده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.canceled')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>باطل شده</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.order.returned')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>مرجوعی</p>
                                    </a>
                                </li>
                            </ul>
                    </ul>
                    @endif
                    {{-- @endif --}}


                    {{-- user section --}}
                    @if (auth()->user()->can('acl'))
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if((auth()->user()->hasRole('super-admin','acl-admin')) or (auth()->user()->can('permission-show') or auth()->user()->can('role-show') or auth()->user()->can('users-show') or auth()->user()->can('admin-user-show') or auth()->user()->can('acl') ))
                        <li class="nav-header">بخش کاربران</li>
                        @endif
                        <li class="nav-item has-treeview">
                            @if (auth()->user()->can('permission-show') or auth()->user()->can('role-show'))
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    سطوح دسترسی
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            @endif
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->can('role-show'))
                                <li class="nav-item">
                                    <a href="{{route('admin.user.role.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>نقش ها</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->can('permission-show'))
                                <li class="nav-item">
                                    <a href="{{route('admin.user.permission.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسترسی ها</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if (auth()->user()->can('admin-user-show'))
                        <li class="nav-item">
                            <a href="{{route('admin.user.admin-user.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>کاربران ادمین</p>
                            </a>
                        </li>                            
                        @endif

                        @if (auth()->user()->can('users-show'))
                        <li class="nav-item">
                            <a href="{{route('admin.user.customer.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>مشتریان</p>
                            </a>
                        </li>                            
                        @endif

                    </ul>                        
                    @endif

            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
