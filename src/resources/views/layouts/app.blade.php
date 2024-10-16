<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    @yield('css')
</head>

<body class="body">
    <div class="hamburger-menu">
        <div class="hamburger" onclick="toggleMenu()">
            <span class="material-icons-outlined" id="menu-icon">
                menu
            </span>
            <span class=" material-icons-outlined" id="close-icon">
                close
            </span>
        </div>
        <div>
            <h1 class="title">Rese</h1>
        </div>
    </div>
    <nav class="menu" id="menu">
        <ul class="menu-list">
            @if (Auth::check())
            @if (Auth::user()->hasAnyRole(['admin']))
            <li><a href="/admin">Management</a></li>
            <li>
                <form class="logout" action="/logout" method="post">
                    @csrf
                    <button class="logout-link">Logout</button>
                </form>
            </li>
            @endif
            @if (Auth::user()->hasAnyRole(['owner']))
            <li><a href="/owner">Management</a></li>
            <li><a href="/mail">Email</a></li>
            <li>
                <form class="logout" action="/logout" method="post">
                    @csrf
                    <button class="logout-link">Logout</button>
                </form>
            </li>
            @endif
            @if (Auth::user()->hasAnyRole(['user']))
            <li><a href="/">Home</a></li>
            <li>
                <form class="logout" action="/logout" method="post">
                    @csrf
                    <button class="logout-link">Logout</button>
                </form>
            </li>
            <li><a href="/mypage">Mypage</a></li>
            @endif
            @else
            <li><a href="/">Home</a></li>
            <li><a href="/register">Registration</a></li>
            <li><a href="/login">Login</a></li>
            @endif
        </ul>
    </nav>

    <main class="main">
        @yield('content')
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')
</body>

</html>