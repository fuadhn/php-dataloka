<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    @include('layouts.navigation')

    <main class="bg-white overflow-scroll position-relative min-vh-100 cs-main">
        <div>
            <div class="d-inline-block w-100 align-middle cs-header-menu">
                <div class="float-start">
                    <div class="cs-header-title">
                        <img class="icon" src="{{ URL::asset('img/icon-product-active.svg') }}" alt="" />
                        <h1 class="label d-inline-block">{{ $page_title }}</h1>
                    </div>
                </div>
                <div class="float-end">
                    <nav class="cs-nav-header">
                        <ul>
                            <li>
                                <img class="avatar" src="{{ URL::asset('img/avatar.jpg') }}" alt="Profile" />
                                <span class="label" style="font-weight: bold; color: #000000;">Miko Haryadi</span>
                            </li>
                            <li>
                                <img src="{{ URL::asset('img/icon-bell.svg') }}" alt="Notification" />
                            </li>
                            <li>
                                <img class="icon" src="{{ URL::asset('img/icon-gear.svg') }}" alt="Setting" />
                                <span class="label">Setting</span>
                            </li>
                            <li>
                                <img class="icon" src="{{ URL::asset('img/icon-logout.svg') }}" alt="Logout" />
                                <span class="label">Logout</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            @yield('content')
        </div>
        
        @yield('footer')
    </main>

    <script src="{{ URL::asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="module" src="{{ URL::asset('js/main.js') }}"></script>
    @yield('js')
</body>
</html>