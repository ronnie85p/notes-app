<x-layout title="{{ $title }}">
    <div class="row">
        <div class="col-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <!-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                    </div>
                    <h3 class="profile-username text-center">{{ $user->fullname }}</h3>
                    <p class="text-muted text-center">Software Engineer</p>

                    <div class="text-center my-4">
                        <a class="btn btn-sm btn-primary" href="{{ route('profile.books.create') }}">Добавить книгу</a>
                    </div>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <a href="{{ route('profile.books.index') }}">Книги</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('profile.categories.index') }}">Категории</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('profile.feedbacks.index') }}">Сообщения</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('profile.settings.show') }}">Настройки</a>
                        </li>
                    </ul>
                </div>
            </div>
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