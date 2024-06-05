<x-layout 
    title="Заметка | редактирование">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>

                К списку
            </a>
        </li>
    </ul>

    <hr />

    <h1 class="h4 mb-0">Заметка</h1>
    <div class="text-muted mb-3">
        от <span class="created-at"></span>
    </div>

    <form onsubmit="app.notes.update(event, '{{ $id }}')">
        <input type="hidden" name="id" value="{{ $id }}">
        @include('notes.form')

        <div class="row">
            <div class="col">
                <button class="btn btn-primary">
                    Сохранить
                </button>
            </div>
        </div>
    </form>
</x-layout>
