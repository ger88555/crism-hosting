<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>CRISM Hosting</title>

    {{-- FRONTOFFICE CSS --}}
    <link href="{{ asset('css/frontoffice.css') }}" rel="stylesheet" />
</head>

<body>

    @include('frontoffice.layout.navbar')


    @hasSection('title')
        <section class="headline-sec">
            <div class="overlay ">
                
                <h3>@yield('title') <i class="fa fa-angle-double-right "></i></h3>

            </div>
        </section>
    @endif

    @yield('content')

    @include('frontoffice.layout.footer')

    {{-- FRONTOFFICE JS --}}
    <script src="{{ asset('js/frontoffice.js') }}"></script>
</body>

</html>
