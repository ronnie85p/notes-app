<x-layout title="Авторизация">
    <div class="login-box m-auto">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="h1"><b>{{ env('APP_NAME') }}</b></a>
            </div>

            <div class="card-body">
                <p class="login-box-msg">Авторизация в системе!</p>

                <x-auth.login.form />

                <p class="mb-0 mt-4">
                    <a href="{{ route('auth.register') }}" class="text-center">Регистрация</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>

