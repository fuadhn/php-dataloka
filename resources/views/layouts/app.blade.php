<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
                        <h1 class="label d-inline-block">Pelanggan : Daftar Pelanggan</h1>
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
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script type="module" src="{{ URL::asset('js/main.js') }}"></script>
    @yield('js')
</body>
</html>