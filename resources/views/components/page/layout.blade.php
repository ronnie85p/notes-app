<html lang="ru">
    <head>
        @include('includes.page.head')
    </head>

    <body>
        <main>
            <header class="header mb-4">
                @include('includes.page.header')
            </header>

            <section class="content">
                <div class="container">
                    @if(isset($navbar))
                        <ul class="navbar-nav mb-4">
                            {{ $navbar }}
                        </ul>
                    @endif

                    <h1 class="h4">{{ $pagetitle ?? $title ?? '' }}</h1>
                    <small class="text-muted">{{ $subtitle ?? '' }}</small>
                    <hr class="my-4"/>

                    {{ $slot }}
                </div>
            </section>

            <footer class="footer">
                @include('includes.page.footer')
            </footer>
        </main>
    </body>
</html>