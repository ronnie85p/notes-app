<x-auth.layout 
    title="Авторизация">

    <div class="row mt-5">
        <div class="col-5 m-auto">

            <div class="card shadow">
                <div class="card-header">
                    <h1 class="h5 card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" style="top: -2px; position: relative;" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg> Авторизация
                    </h1>
                </div>

                <div class="card-body">

                    <form onsubmit="app.auth.login(event)">
                        <div class="form-feedback"></div>

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
</x-auth.layout>
