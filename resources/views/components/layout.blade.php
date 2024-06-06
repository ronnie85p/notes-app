<html lang="ru">
    <head>
        @includes('includes.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('includes.header')
            </header>

            <section class="content">
                <div class="container">
                    {{ $slot }}
                </div>
            </section>

            <footer class="footer">
                @include('includes.footer')
            </footer>
        </main>
    </body>
</html>