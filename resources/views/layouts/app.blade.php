<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>COA Testing App</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">COA Testing App</a>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Hai, {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action p-3 {{ request()->is('kategori-coa') ? 'active' : '' }}" href="{{ url('kategori-coa') }}">
                <i class="fa-solid fa-list"></i> Kategori
            </a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->is('chart-of-account') ? 'active' : '' }}" href="{{ url('chart-of-account') }}">
                <i class="fa-solid fa-chart-pie"></i> Chart of Account (COA)
            </a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->is('transaksi') ? 'active' : '' }}" href="{{ url('transaksi') }}">
                <i class="fa-solid fa-exchange-alt"></i> Transaksi
            </a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->is('profit-loss') ? 'active' : '' }}" href="{{ url('profit-loss') }}">
                <i class="fa-solid fa-file-alt"></i> Profit/Loss
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
</body>
<footer class="mt-4 text-center">
    <p>© 2024 COA Testing App - Iqbal</p>
</footer>
</html>
