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

                            @include('chunks.profile.menu', ['active' => 'profile.editpassword'])

                        </div>
                        <div class="col">
                            @include('chunks.profile.title', ['title' => 'Изменить пароль'])

                            <form onsubmit="app.profile.updatePassword(event)">
                                <div class="form-feedback"></div>

                                <div class="row mb-2">
                                    <label class="col-3" for="fullname">Старый пароль</label>
                                    <div class="col">
                                        <input class="form-control" name="password" type="password">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label class="col-3" for="fullname">Новый пароль</label>
                                    <div class="col">
                                        <input class="form-control" name="new_password" type="password">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col">
                                        <button class="btn btn-primary">Обновить</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                </div>
            </section>

            <footer class="footer">
                @include('chunks.footer')
            </footer>
        </main>
    </body>
</html>