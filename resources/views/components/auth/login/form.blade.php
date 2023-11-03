<form class="form" id="auth-login-form">
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

    <div class="row mb-3">
        <div class="col">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Запомнить меня</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </div>
    </div>
</form>