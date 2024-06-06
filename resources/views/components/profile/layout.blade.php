<html lang="ru">
    <head>
        @include('includes.profile.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('includes.profile.header')
            </header>

            <section class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-3">
                            @include('includes.profile.menu', ['active' => 'profile.show'])
                        </div>

                        <div class="col">
                            <h1 class="h4">{{ $pagetitle ?? $title }}</h1>
                            <small class="text-muted">{{ $subtitle ?? '' }}</small>
                            <hr class="my-4">

                            {{ $slot }}
                        </div>
                    </div>

                </div>
            </section>

            <footer class="footer">
                @include('includes.profile.footer')
            </footer>
        </main>
    </body>
</html>