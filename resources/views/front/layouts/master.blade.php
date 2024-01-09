<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    @include('front.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    <div>
        @include('front.layouts.header')
    </div>


    @yield('content')
        <!-- FOOTER -->
        @include('front.layouts.footer')
    </body>
    @include('front.layouts.script')

    </html>
