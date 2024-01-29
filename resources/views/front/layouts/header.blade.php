<div>

     <!-- TOP -->
      <nav
        class="relative px-5 py-2 flex flex-wrap justify-between items-start pt-5 bg-white">
        <a class="order-2" href="./index.html">
          <img class="w-36" src="{{asset('front-assets/image/logo.png')}}" alt="" />
        </a>
        <div class="order-3 w-full mt-3 lg:mt-0 lg:w-5/12 lg:mr-[10%]">
          <div class="relative">
            <form action="{{route('front.products',request()->category ? request()->category->id : null)}}" method="get">
              @csrf
              <input
              type="text"
              name="search"
              value="{{request()->search}}"
              id="search"
              class="sm:block w-full px-4 py-3 sm:pl-12 text-sm sm:text-base pl-8 text-red-900 placeholder:text-red-600 rounded-2xl text-right placeholder:text-sm focus:outline-red-400 border-2 border-red-400"
              placeholder="جستجو محصول"
              />  
            </form>
            <div
              class="absolute inset-y-0 left-0 flex items-center pl-4">
              <img class="w-5 h-5 text-gray-500" src="{{asset('front-assets/image/search.png')}}" alt="" />
            </div>
          </div>
        </div>

        <div class="order-4 hidden lg:flex">
          
          {{-- user profile --}}
          @auth
          <span
            class="block relative"
            x-data="{showChildren:false}"
            @mouseenter="showChildren=true"
            @mouseleave="showChildren=false">
            <a
              href="{{route('front.profile.update')}}"
              class="flex items-center h-10 leading-10 px-3 mx-1 transition rounded-xl hover:bg-red-50">
              <img class="ml-1 w-6" src="{{asset('front-assets/image/user.png')}}" alt="" />
              <span
                class="text-sm opacity-95"
                >
                {{auth()->user()->name ?? auth()->user()->first_name.' '.atuh()->user()->last_name}}
              </span>
              <span>
                <img class="w-4 mr-1" src="{{asset('front-assets/image/chevron-down-login.png')}}" alt="" />
              </span>
            </a>
            <div
              class="bg-white rounded-2xl shadow-md border-gray-50 text-sm absolute top-auto right-0 w-64 z-30 mt-1"
              x-show="showChildren"
              x-transition:enter="transition ease duration-300 transform"
              x-transition:enter-start="opacity-0 translate-y-2"
              x-transition:enter-end="opacity-100 translate-y-0"
              x-transition:leave="transition ease duration-300 transform"
              x-transition:leave-start="opacity-100 translate-y-0"
              x-transition:leave-end="opacity-0 translate-y-4"
              style="display: none"
              @mouseenter="showChildren=true"
              @mouseleave="showChildren=false">
              <div class="bg-white rounded-2xl w-full relative z-10 py-2 px-2">
                <ul class="list-reset">
                  <li
                    class="relative border-b-2 border-red-300 pb-2"
                    x-data="{showChildren:false}"
                    @mouseleave="showChildren=false"
                    @mouseenter="showChildren=true">
                    <a
                      href="{{route('front.profile.profile')}}"
                      class="px-2 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span
                        class="flex justify-center items-center opacity-90"
                        ><img
                          class="w-8 ml-2"
                          src="{{asset('front-assets/image/userNotImage.png')}}"
                          alt="" />پروفایل</span
                      >
                    </a>
                  </li>
                  <li
                    class="relative pt-2"
                    x-data="{showChildren:false}"
                    @mouseleave="showChildren=false"
                    @mouseenter="showChildren=true">
                    <a
                      href="{{route('front.profile.orders')}}"
                      class="px-4 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span class="flex justify-center items-center text-sm opacity-90"
                        ><img
                          class="w-5 ml-1"
                          src="{{asset('front-assets/image/package.png')}}"
                          alt="" />سفارش ها</span
                      >
                    </a>
                  </li>
                  <li
                    class="relative"
                    x-data="{showChildren:false}"
                    @mouseleave="showChildren=false"
                    @mouseenter="showChildren=true">
                    <a
                      href="{{route('front.profile.favorites')}}"
                      class="px-4 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span class="flex justify-center items-center text-sm opacity-90"
                        ><img
                          class="w-5 ml-1"
                          src="{{asset('front-assets/image/heart.png')}}"
                          alt="" />علاقه مندی ها</span
                      >
                    </a>
                  </li>
                  <li
                    class="relative"
                    x-data="{showChildren:false}"
                    @mouseleave="showChildren=false"
                    @mouseenter="showChildren=true">
                    <a
                      href="{{route('auth.logout')}}"
                      class="px-4 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span class="flex justify-center items-center text-sm opacity-90"
                        ><img class="w-5 ml-1" src="{{asset('front-assets/image/exit.png')}}" alt="" />خروج
                        از حساب کاربری</span
                      >
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </span>     
          @endauth
          
          
          {{-- login-register button --}}
          @guest
          <span
          class="block relative">
          <a
            href="{{route('auth.login-register-form')}}"
            class="flex items-center h-10 leading-10 px-3 mx-1 transition rounded-xl hover:bg-red-50">
            <img class="ml-1 w-6" src="{{asset('front-assets/image/user.png')}}" alt="" />
            <span
              class="text-sm opacity-95"
              >
              ورود | ثبت نام
            </span>
          </a>
        </span>  
          @endguest

          {{-- cart button --}}
          <span
            class="block relative"
            x-data="{showChildren:false}"
            @click.away="showChildren=false"
            @mouseenter="showChildren=true"
            @mouseleave="showChildren=false">
            <a
              href="{{route('front.sales-process.cart')}}"
              class="flex items-center h-10 leading-10 px-3 cursor-pointer no-underline hover:no-underline duration-100 mx-1 transition rounded-xl hover:bg-red-100">
              <img
                class="inline ml-1 w-5"
                src="{{asset('front-assets/image/shopping-cart.png')}}"
                alt="" />
                @if (isset($cartItems))
                <span style="top: 80%;" class="position-absolute start-0 translate-middle badge rounded-pill bg-danger">


                  @php
                  if(!isset($cartItems)) {
                    $cartItems=collect();
                  }
                  @endphp

                  @if ($cartItems->count() > 0)
                  {{$cartItems->count()}}
                  @else
                  0
                  @endif

                </span>                  
                @endif

              <span
                class="text-sm text-neutral-800 hover:text-neutral-700 opacity-95">
                سبد خرید 
              </span>
 
              <span>
                <img class="w-4 mr-1" src="{{asset('front-assets/image/chevron-down-login.png')}}" alt="" />
              </span>
            </a>
            <div
              class="bg-white rounded-2xl shadow-md first-letter:border-2 border-gray-50 text-sm absolute top-auto left-0 w-72 z-30 mt-1"
              x-show="showChildren"
              x-transition:enter="transition ease duration-300 transform"
              x-transition:enter-start="opacity-0 translate-y-2"
              x-transition:enter-end="opacity-100 translate-y-0"
              x-transition:leave="transition ease duration-300 transform"
              x-transition:leave-start="opacity-100 translate-y-0"
              x-transition:leave-end="opacity-0 translate-y-4"
              style="display: none"
              @mouseenter="showChildren=true"
              @mouseleave="showChildren=false">
              <div class="bg-white rounded-2xl w-full relative z-10 py-2 px-2">
                <ul class="list-reset flex flex-col gap-y-2">
                  
                  @guest
                  @if (session('shoppingCart'))
                  @foreach (session('shoppingCart') as $key=> $product)
                 <li
                 class="relative">
                    <a href="{{route('front.market.product',$product['productObject']['id'])}}"
                      class="px-2 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span class="flex justify-center items-center opacity-90">
                        <div class="flex">
                          <img class="w-14 ml-2 rounded-lg" src="{{ asset($product['productObject']['image']['indexArray']['medium']) }}" alt="" />
                          <div class="flex flex-col flex-wrap gap-y-1 justify-center">
                            <div class="opacity-80 w-full text-sm">
                              {{$product['productObject']['name']}}
                            </div>
                            <div class="flex opacity-75 text-xs">
                              <div>
                                قیمت:
                              </div>
                              <div>
                               {{PriceFormat($product['productObject']['price'])}}
                              </div>
                              <div>
                                تومان
                              </div>
                            </div>
                          </div>
                          <form action="{{route('front.sales-process.remove-from-cart-session',[$product['productObject']['id'],$product['color_id'],$product['guarantee_id'] ])}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-400 hover:text-red-500 bg-red-100 hover:bg-red-200 px-2 text-xl font-bold h-7 rounded-full cursor-pointer absolute left-2 top-5">
                              ×
                            </button>
                          </form>

                        </div>
                      </span>
                    </a>
                  </li>                      
                  @endforeach
                  @else
                  <li class="relative">ایتمی وجود ندارد</li>
                  @endif
                  @endguest
                
                  @auth
                  @if ($cartItems->count() > 0)                    
                  @foreach ($cartItems as $cartItem)                    
                  <li
                  class="relative">
                    <a
                      href="{{route('front.market.product',$cartItem->product)}}"
                      class="px-2 py-2 flex w-full items-start hover:bg-red-50 rounded-xl">
                      <span class="flex justify-center items-center opacity-90">
                        <div class="flex">
                          <img
                          class="w-14 ml-2 rounded-lg"
                          src="{{asset($cartItem->product->image['indexArray']['medium'])}}"
                          alt="" />
                          <div class="flex flex-col flex-wrap gap-y-1 justify-center">
                            <div class="opacity-80 w-full text-sm">
                              {{$cartItem->product->name}}
                            </div>
                            {{-- <div class="flex opacity-75 text-xs">
                              <div>
                                قیمت:
                              </div>
                              <div>
                                {{PriceFormat($cartItem->product->price)}}
                              </div>
                              <div>
                                تومان
                              </div>
                            </div> --}}
                          </div>
                          <form action="{{route('front.sales-process.remove-from-cart',$cartItem)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-400 hover:text-red-500 bg-red-100 hover:bg-red-200 px-2 text-xl font-bold h-7 rounded-full cursor-pointer absolute left-2 top-5">
                              ×
                            </button>
                          </form>                          
                        </div>
                      </span>
                    </a>
                  </li>
                  @endforeach
                  @else
                  <li class="relative">ایتمی وجود ندارد</li>
                  @endif
                  @endauth

                  @php
                    if(!isset($cartItems)) {
                      $cartItems=collect();
                    }
                  @endphp

                  @if (session('shoppingCart') or $cartItems->count() > 0)
                  <li
                    class="relative">
                    <a
                      href="{{route('front.sales-process.cart')}}"
                      class="px-2 py-2 flex w-full items-start justify-center">
                      <span class="flex justify-center items-center opacity-90">
                        <button class="px-7 py-2 text-center text-white bg-red-500 align-middle border-0 rounded-lg shadow-md text-xs">تسویه حساب</button>
                      </span>
                    </a>
                  </li>                    
                  @endif

                </ul>
              </div>
            </div>
          </span>
        </div>
     
        <div class="order-1 lg:hidden">
          <button class="navbar-burger flex items-center text-red-300 p-3">
            <svg
              class="block h-4 w-4 fill-current"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
          </button>
     
        </div>
     
      </nav>


      <!-- DOWN -->
      <div class="w-full">
        <div class="py-2 px-5 bg-white shadow-stone-50 shadow-md hidden lg:block">
          <div class="-mx-1">
            <ul class="flex w-full flex-wrap items-center h-10">
              <li class="block relative">
                <a
                  href="{{route('front.home')}}"
                  class="flex items-center h-10 text-sm leading-10 px-4 mx-1 transition text-gray-700 hover:text-red-500">
                  <span class=" border-b-2 border-red-600">صفحه اصلی</span>
                </a>
              </li>
              @foreach ($categories as $category)
              <li
                class="block relative"
                x-data="{showChildren:false}"
                >
                <a
                  href="{{route('front.products',$category)}}"
                  class="flex items-center h-10 leading-10 px-3 text-sm mx-1 transition text-gray-700 hover:text-red-500"
                  @click.prevent="showChildren=!showChildren"
                  @mouseenter="showChildren=true"
                  @mouseleave="showChildren=false">
                  <span>{{$category->name}}</span>
                  <span>
                    <img class="w-4 mr-1" src="{{asset('front-assets/image/chevron-down-login.png')}}" alt="" />
                  </span>
                </a>
                <div
                  class="bg-white rounded-2xl shadow-md text-sm  opacity-[0.97] absolute top-auto right-0 min-w-full w-56 z-30 mt-3"
                  x-show="showChildren"
                  x-transition:enter="transition ease duration-300 transform"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease duration-300 transform"
                  x-transition:leave-start="opacity-100 translate-y-0"
                  x-transition:leave-end="opacity-0 translate-y-4"
                  style="display: none"
                  @mouseenter="showChildren=true"
                  @mouseleave="showChildren=false">
                  
                  @forelse ($category->children as $child)
                  <div class="bg-white rounded-2xl w-full relative z-10 py-2 px-2">
                    <ul class="list-reset">
                      <li
                        class="relative">
                        <a
                          href="{{route('front.products',$child)}}"
                          class="px-4 py-2 flex w-full items-start hover:bg-red-100 rounded-lg transition no-underline hover:no-underline duration-100 cursor-pointer">
                          <span class="flex-1">{{$child->name}}</span>
                        </a>
                      </li>
                    </ul>      
                  </div>
                    @empty

                    @endforelse


                </div>
              </li>                
              @endforeach

              <li class="block relative">
                <a
                  href="{{route('front.blogs.index')}}"
                  class="flex items-center h-10 text-sm leading-10 px-4 mx-1 transition text-gray-700 hover:text-red-500">
                  <span class=" border-b-2 border-red-600">بلاگ</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--MOBILE NAVBAR-->
      <div class="navbar-menu relative z-50 hidden">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav
          class="fixed top-0 right-0 bottom-0 flex flex-col w-5/6 max-w-sm py-5 px-6 bg-white border-r overflow-y-auto">
          <div class="flex justify-center items-center mb-4">
            <a class="order-1" href="./index.html">
              <img class="w-32" src="{{asset('front-assets/image/logo.png')}}" alt="" />
            </a>
          </div>
          <div>
            <ul class="space-y-3">
              <li class="border-b">
                <div class="mt-0 mb-3 text-center space-y-5">
                  <div>
                    <div
                      class="md:flex justify-center align-middle lg:inline-block py-2 px-4 text-sm text-neutral-800 rounded-xl hover:text-neutral-700 hover:bg-red-100 transition">
                      <a href="./cart.html">
                        <img
                          class="inline ml-1 w-5"
                          src="{{asset('front-assets/image/shopping-cart.png')}}"
                          alt="" />سبد خرید</a
                      >
                    </div>
                    <div
                      class="md:flex justify-center align-middle lg:inline-block py-2 px-4 text-sm text-neutral-800 rounded-xl hover:text-neutral-700 hover:bg-red-100 transition">
                      <a href="./login-register.html"
                        ><img
                          class="inline ml-1 w-5"
                          src="{{asset('front-assets/image/user.png')}}"
                          alt="" />ورود | ثبت نام</a
                      >
                    </div>
                  </div>
                </div>
              </li>
              <li
                class="relative flex"
                x-data="{showChildren:false}"
                @click.away="showChildren=false">
                <a
                  href="./category-index.html"
                  class="flex justify-between items-center h-10 leading-10 text-sm opacity-90 px-3 cursor-pointer no-underline w-full hover:no-underline duration-100 mx-1 transition rounded-xl hover:bg-red-100"
                  @click.prevent="showChildren=!showChildren">
                  <span>پوشاک</span>
                  <span>
                    <img class="w-4 mr-1" src="{{asset('front-assets/image/chevron-down-login.png')}}" alt="" />
                  </span>
                </a>
                <div
                  class="bg-white rounded-2xl shadow-lg border-1 border-gray-50 text-sm absolute top-full right-0 min-w-full w-56 z-30 mt-1"
                  x-show="showChildren"
                  x-transition:enter="transition ease duration-300 transform"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease duration-300 transform"
                  x-transition:leave-start="opacity-100 translate-y-0"
                  x-transition:leave-end="opacity-0 translate-y-4"
                  style="display: none">
                  </span>
                  <div
                    class="bg-white rounded-2xl w-full relative z-10 py-2 px-2">
                    <ul class="list-reset">
                      <li
                        class="relative"
                        x-data="{showChildren:false}"
                        @mouseleave="showChildren=false"
                        @mouseenter="showChildren=true">
                        <a
                          href="./category.html"
                          class="px-4 py-2 flex w-full items-start hover:bg-red-100 rounded-lg transition no-underline hover:no-underline duration-100 cursor-pointer">
                          <span class="flex-1">مردانه</span>
                        </a>
                      </li>
                      <li
                        class="relative"
                        x-data="{showChildren:false}"
                        @mouseleave="showChildren=false"
                        @mouseenter="showChildren=true">
                        <a
                          href="./category.html"
                          class="px-4 py-2 flex w-full items-start hover:bg-red-100 rounded-lg transition no-underline hover:no-underline duration-100 cursor-pointer">
                          <span class="flex-1">زنانه</span>
                        </a>
                      </li>
                      <li
                        class="relative"
                        x-data="{showChildren:false}"
                        @mouseleave="showChildren=false"
                        @mouseenter="showChildren=true">
                        <a
                          href="./category.html"
                          class="px-4 py-2 flex w-full items-start hover:bg-red-100 rounded-lg transition no-underline hover:no-underline duration-100 cursor-pointer">
                          <span class="flex-1">بچگانه</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- OPACITY SCREEN FOR SEARCH INPUT FOCUS -->
      <div class="absolute w-full h-screen bg-gray-200 opacity-40 z-40 hidden" id="opacitiScreen" onclick="closeScreen()">
      </div>
    </div>
