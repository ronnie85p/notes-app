<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">

        <div class="fs-4"><a class="text-dark" href="{{ route('home') }}">{{ env('APP_NAME') }}</a></div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav">

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->fullname }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-item">
                            <a href="{{ route('profile.show') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg> Профиль
                            </a>
                        </li>
                        <li><form class="mb-0" onsubmit="app.auth.logout(event)">
                            <button class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                </svg> Выйти
                            </button>
                        </form></li>
                    </ul>
                </li>                         
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.signin') }}">
                        Вход
                    </a>
                </li>

                <li class="nav-item"><span style="position:relative; top: 8px">/</span></li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.signup') }}">
                        Регистрация
                    </a>
                </li>
            @endauth

        </ul>
    </div>
</nav>