<!DOCTYPE html>
<html lang="en" @if (Route::currentRouteName() == 'rtl_layout') dir="rtl" @endif
    @if (Route::currentRouteName() === 'layout_dark') data-theme="dark" @endif>

<head>
    @include('layouts.head')
    @include('layouts.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @yield('main_content')

    @include('layouts.scripts')
</body>

</html>
