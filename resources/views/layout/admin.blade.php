<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')-Blog</title>
    @include('admin.components.styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper"> <!--begin::Header-->
        @include('admin.components.navbar')
        @include('admin.components.sidebar')
        <main class="app-main"> <!--begin::App Content Header-->
            @include('admin.components.header')
            @yield('content')
        </main> <!--end::App Main--> <!--begin::Footer-->
        @include('admin.components.footer')
    </div>

    @include('admin.components.scripts')
</body>


</html>
