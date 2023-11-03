<x-profile title="Редактирование">

    <x-profile.content>
        <form class="form" id="profile-book-edit-form">
            <input type="hidden" name="id" value="{{ $data->id }}" />

            <div class="row form-group">
                <label class="col-3" for="category_id">Категория</label>
                <div class="col">
                    <select class="form-control" name="category_id" id="">
                        <option value="">-- Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="title">Название</label>
                <div class="col">
                    <input class="form-control" type="text" name="title" value="{{ $data->title }}" autocomplete="off" />
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="short_description">Краткое описание</label>
                <div class="col">
                <textarea class="form-control" name="short_description" id="" cols="30" rows="4" autocomplete="off">{{ $data->short_description }}</textarea>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="long_description">Описание</label>
                <div class="col">
                    <textarea class="form-control" name="long_description" id="" cols="30" rows="6" autocomplete="off">{{ $data->long_description }}</textarea>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="isbn">ISBN</label>
                <div class="col">
                    <input class="form-control" type="text" name="isbn" value="{{ $data->isbn }}"  autocomplete="off" />
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="page_count">Кол-во страниц</label>
                <div class="col">
                    <input class="form-control" type="text" name="page_count" value="{{ $data->page_count }}"  autocomplete="off" />
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="authors">Автор</label>
                <div class="col">
                    <input class="form-control" type="text" name="authors" value="{{ $data->str_authors }}" autocomplete="off" />
                    <div class="text-muted text-sm pl-3">Укажите через запятую несколько авторов</div>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-3" for="poster">Постер</label>
                <div class="col">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="poster" accept="image/*" id="poster-file">
                        <label class="custom-file-label" for="poster-file">Выберите файл</label>
                    </div>

                    <div id="poster-prev">
                        <div class="poster-prev-image">
                            <img class="img-thumbnail mb-2 d-block" src="{{ $data->thumbnail_url }}" width="300"/>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row form-group">
                <div class="col-3"></div>
                <div class="col">
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
            </div>
        </form>
    </x-profile.content>
</x-profile>