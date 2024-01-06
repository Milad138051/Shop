<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
      <img src="{{asset('admin-assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{route('admin.home')}}" class="d-block">پنل مدیریت</a>
          </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">محتوا</li>
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
                  <a href="{{route('admin.content.post.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>پست ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.content.postCategory.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>دسته بندی ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.content.comment.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>نظرات</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>


          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                  <a href="{{route('admin.market.category.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>دسته بندی</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.market.brand.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>برند ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.market.product.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>کالاها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.market.property.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>فرم کالا</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.market.comment.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>نظرات</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>


          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                  <a href="#" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>نقش ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>دسترسی ها</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>کاربران ادمین</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
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