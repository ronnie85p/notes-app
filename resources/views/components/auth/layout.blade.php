<html lang="ru">
    <head>
        @include('includes.auth.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('includes.auth.header')
            </header>

            <section class="content">
                <div class="container">
                    {{ $slot }}
                </div>
            </section>

            <footer class="footer">
                @include('includes.auth.footer')
            </footer>
        </main>
    </body>
</html>