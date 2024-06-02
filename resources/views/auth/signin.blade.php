<html lang="ru">
    <head>
        @include('chunks.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('chunks.header2')
            </header>

            <section class="content">
                <div class="container">

                    <div class="row mt-5">
                        <div class="col-5 m-auto">

                            <div class="card shadow">
                                <div class="card-header">
                                    <h5 class="card-title">Авторизация</h5>
                                </div>

                                <div class="card-body">
                                    <div id="auth-msg"></div>

                                    <form id="auth-login">
                                        <div class="row mb-3">
                                            <label class="form-label col-4">Логин</label>
                                            <div class="col">
                                                <input class="form-control" name="username" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label col-4">Пароль</label>
                                            <div class="col">
                                                <input class="form-control" name="password" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-4"></div>
                                            <div class="col text-end">
                                                <button class="btn btn-primary">Войти</button>
                                            </div>
                                        </div>
                                    </form>

                                    <hr />

                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('auth.signup') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="top: -2px; position: relative;" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                </svg>
                                                Новый пользователь?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

            <footer class="footer">
                @include('chunks.footer')
            </footer>
        </main>
    </body>
</html>
