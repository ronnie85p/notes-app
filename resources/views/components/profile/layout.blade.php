<html lang="ru">
    <head>
        <title>{{ $title ?? env('APP_NAME') }}</title>

        <meta charset="utf-8">
        <meta name="csrf" content="{{ csrf_token() }}">

        <link href="/assets/css/vendor/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">

        <script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/vendor/axios.min.js"></script>
        <script src="/assets/js/app.js"></script>
        <script src="/assets/js/form.js"></script>
        <script src="/assets/js/http.js"></script>
        <script src="/assets/js/auth.js" defer></script>
        <script src="/assets/js/notes.js" defer></script>
        <script src="/assets/js/profile.js" defer></script>
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
                            <h1 class="h4">{{ $title ?? '' }}</h1>
                            @if(isset($subtitle))
                                <p class="text-muted">{{ $subtitle }}</p>
                            @endif
                            <div class="my-4"></div>

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