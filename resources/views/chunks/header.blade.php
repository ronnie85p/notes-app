<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">
        @include('chunks.brand')

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
                        <li><form class="mb-0" id="auth-logout">
                            <button class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                </svg>

                                Выйти
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