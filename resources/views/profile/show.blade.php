<html lang="ru">
    <head>
        @include('chunks.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('chunks.header')
            </header>

            <section class="content">
                <div class="container">

                <div class="row">
                        <div class="col-3">

                            @include('chunks.profile.menu', ['active' => 'profile.show'])

                        </div>
                        <div class="col">
                            @include('chunks.profile.title', ['title' => 'Профиль'])

                            <p><b>Логин</b>: {{ $user->username }}</p>
                            <p><b>Полное имя</b>: {{ $user->fullname }}</p>
                            <p class="text-muted">Дата регистрации: {{ $user->created_at }}</p>
                            <hr />
                            <a href="{{ route('profile.edit') }}">Редактировать</a>
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