<x-profile.layout
    title="Профиль"
    subtitle="Редактирование">

    <form onsubmit="app.profile.update(event)">
        <div class="form-feedback"></div>

        <div class="row mb-2">
            <label class="col-2" for="username">Логин</label>
            <div class="col">
                <input class="form-control" name="username" value="{{ $user->username }}">
                <div class="invalid-feedback"></div>
            </div>
        </div>

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
</x-profile.layout>