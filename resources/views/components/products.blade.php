<x-layout title="{{ $title }}">
    <div class="row">
        <div class="col-3">
            <h3 class="h4">Категории</h3>

            <div id="categories"></div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4 h1">{{ $title }}</h1>
                    <hr class="mb-3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-layout>