<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    @include('front.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="bg-gray-50">
    <!-- NAVBAR -->
    @include('front.layouts.header')
    @include('admin.alerts.alert-section.success')
    @include('admin.alerts.alert-section.error')
    @include('admin.alerts.alert-section.warning')
    @yield('content')
    <!-- FOOTER -->
    @include('front.layouts.footer')
</body>
@include('front.layouts.script')
@yield('script')



{{-- <section class="toast-wrapper flex-row-reverse">
    @include('admin.alerts.toast.success')
    @include('admin.alerts.toast.error')
</section> --}}
@include('admin.alerts.sweetalert.success')
@include('admin.alerts.sweetalert.error')



</html>
