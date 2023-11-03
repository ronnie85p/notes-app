<x-products title="Книги">

    <form class="form mb-4" id="books-filter-form">
        <div class="row mb-2">
            <div class="col-5">

                <div class="mb-2">
                    <input class="form-control" type="text" placeholder="Поиск...">
                </div>

                <div class="custom-control custom-radio d-inline">
                    <input class="custom-control-input" type="radio" id="searchby-name" name="searchby" checked>
                    <label for="searchby-name" class="custom-control-label">Названию</label>
                </div>
                <div class="custom-control custom-radio d-inline">
                    <input class="custom-control-input" type="radio" id="searchby-author" name="searchby">
                    <label for="searchby-author" class="custom-control-label">Автору</label>
                </div>
            </div>

            <div class="col-3">
                <select class="form-control" name="status" id="">
                    <option value="">Все</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col"></div>
        </div>
    </form>

    <div id="books"></div>
</x-products>