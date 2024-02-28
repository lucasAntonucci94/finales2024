<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="<?= url('css/style.css');?>">
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= url('font-awesome/css/font-awesome.min.css');?>">
</head>
<body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100  text-white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="<?= url('/');?>">
                    <img
                    src="{{ asset('images/icons/fantasma.png') }}"
                    alt="LOGOTIPO"
                    >
                </a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white px-3 font-weight-bold" aria-current="page" href="<?= url('/');?>">Inicio</a>
                    </li>
                </ul>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 font-weight-bold" href="<?= url('admin/dashboard');?>">Panel de control</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-link px-3 nav-link text-white font-weight-bold">Cerrar Sesión</button>
                            </form>
                        </li>
                    @endauth
                    </ul>
                </div>
            </div>
        </nav>

    </div>

    <main class="container-fluid" style="padding:0px;">
        @yield('main')
    </main>
    <footer class="footer">
        <p>Final Portales y Comercio Electrónico &copy; 2024 - Antonucci Lucas & Yamamoto Ana</p>
    </footer>
    @yield('script')
</body>
</html>
