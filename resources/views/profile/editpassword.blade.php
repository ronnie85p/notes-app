<x-profile.layout>
    <x-slot:title>Изменить пароль</x-slot:title>

    <form onsubmit="app.profile.updatePassword(event)">
        <div class="form-feedback"></div>

        <div class="row mb-2">
            <label class="col-3" for="fullname">Старый пароль</label>
            <div class="col">
                <input class="form-control" name="password" type="password">
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-3" for="fullname">Новый пароль</label>
            <div class="col">
                <input class="form-control" name="new_password" type="password">
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <button class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </form>
</x-profile.layout>