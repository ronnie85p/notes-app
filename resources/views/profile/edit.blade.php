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
                            @include('chunks.profile.title', ['title' => 'Профиль', 'subtitle' => 'Редактирование'])

                            <form onsubmit="app.profile.update(event)">
                                <div class="form-feedback"></div>
                            
                                <div class="row mb-2">
                                    <label class="col-2" for="fullname">Полное имя</label>
                                    <div class="col">
                                        <input class="form-control" name="fullname" value="{{ $user->fullname }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col">
                                        <button class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </form>
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