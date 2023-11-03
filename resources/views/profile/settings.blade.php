<x-profile title="Настройки">
    <form class="form" id="profile-settings-form">
        <div class="form-message alert alert-warning"></div>
        <div class="form-message alert alert-success" data-type="success"></div>

        <div class="row form-group">
            <label class="form-label col-3" for="books_limit_on_page">Кол-во книг на странице</label>
            <div class="col">
                <input class="form-control" name="books_limit_on_page" value="{{ $settings?->books_limit_on_page }}" placeholder="" autocomplete="off" />
            </div>
        </div>

        <div class="row form-group">
            <label class="form-label col-3" for="email">E-mail</label>
            <div class="col">
                <input class="form-control" name="email" type="email" value="{{ $settings?->email }}" placeholder="" autocomplete="off" />
            </div>
        </div>

        <div class="row form-group">
            <label class="form-label col-3" for="books_source_url">Источник книг</label>
            <div class="col">
                <input class="form-control" name="books_source_url" value="{{ $settings?->books_source_url }}" placeholder="" autocomplete="off" />
            </div>
        </div>
        <hr />

        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
</x-profile>