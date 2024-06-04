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
                        <div class="col-6 m-auto">

                            <div class="card shadow">
                                <div class="card-header">
                                    <h5 class="card-title">Регистрация</h5>
                                </div>

                                <div class="card-body">
                                    <div id="auth-msg"></div>

                                    <form onsubmit="app.auth.register(event)">
                                        <div class="form-feedback"></div>
                                        
                                        <div class="row mb-3">
                                            <label class="form-label col-5">Имя</label>
                                            <div class="col">
                                                <input class="form-control" name="fullname" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label col-5">Логин</label>
                                            <div class="col">
                                                <input class="form-control" name="username" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label col-5">Пароль</label>
                                            <div class="col">
                                                <input class="form-control" name="password" type="password" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label col-5">Повторите пароль</label>
                                            <div class="col">
                                                <input class="form-control" name="password_again" type="password" autocomplete="off">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-5"></div>
                                            <div class="col text-end">
                                                <button class="btn btn-primary">Зарегистрироваться</button>
                                            </div>
                                        </div>
                                    </form>

                                    <hr />

                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('auth.signin') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="top: -2px; position: relative;" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                                </svg>
                                                Войти
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
