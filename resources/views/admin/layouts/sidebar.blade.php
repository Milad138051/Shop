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
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-header">محتوا</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.content.faq.index') }}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>سوالات متداول</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-envelope-o"></i>
                            <p>
                                بلاگ
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.content.post.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پست ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.content.postCategory.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دسته بندی ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.content.comment.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>نظرات</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-header">فروشگاه</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tree"></i>
                            <p>
                                ویترین
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.market.category.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دسته بندی</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.brand.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>برند ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.product.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>کالاها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.property.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>فرم کالا</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.comment.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>نظرات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.delivery.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>روش ارسال</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.banner.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>بنرها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.market.store.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>انبار</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>
                                    تخفیف ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.copan')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>کد تخفیف</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.commonDiscount')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>تخفیف عمومی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.market.discount.amazingSale')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>فروش شگفت انگیز</p>
                                    </a>
                                </li>
                            </ul>
                    </ul>

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


                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">بخش کاربران</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    سطوح دسترسی
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.user.role.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>نقش ها</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.user.permission.index')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسترسی ها</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.user.admin-user.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>کاربران ادمین</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.user.customer.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>مشتریان</p>
                            </a>
                        </li>
                    </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
