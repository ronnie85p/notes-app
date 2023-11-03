<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?: "Laravel"}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/assets/css/common.css">
    </head>
    <body class="layout-top-nav">
        <div class="wrapper">

            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
                    </a>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('books.index') }}" class="nav-link">Книги</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('feedback') }}" class="nav-link">Обратная связь</a>
                            </li>
                        </ul>
                    </div>

                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <!-- <i class="fas fa-user"></i> -->
                                    <i class="fas fa-user"></i>
                                    
                                    {{ $user->fullname}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Перейти в профиль</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profile.feedbacks.index') }}">Сообщения</a>
                                    <a class="dropdown-item" href="{{ route('profile.settings.show') }}">Настройки</a>
                                    <div class="dropdown-divider"></div>
                                    <a  class="dropdown-item" href="#" onclick="common.auth.logout()">Выйти</a>
                                </div>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.register') }}">
                                    Регистрация
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.login') }}">
                                    Войти
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <div class="content-wrapper py-4" style="min-height: 320.4px;"> 
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
        <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="/assets/js/http.js"></script>
        <script src="/assets/js/api.js"></script>
        <script src="/assets/js/common.js"></script>
    </body>
</html>