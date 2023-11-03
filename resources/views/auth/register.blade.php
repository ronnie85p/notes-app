<x-layout title="Регистрация">
    <div class="card card-outline card-primary m-auto" style="max-width: 400px">
        <div class="card-header text-center">
            <a href="{{ route('home') }}" class="h1">{{ env('APP_NAME') }}</a>
        </div>

        <div class="card-body">
            <p class="login-box-msg">Регистрация</p>

            <form class="form" id="auth-register-form">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Полное имя">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_again" placeholder="Повторите пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreed" name="agreed" value="1">
                            <label for="agreed">
                                Я принимаю <a href="#">пользовательское соглашение</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('auth.login') }}" class="text-center">Войти</a>
        </div>

    </div>
</x-layout>