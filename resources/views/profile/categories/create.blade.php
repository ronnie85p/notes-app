<x-profile title="Новая категория">
    <x-profile.content>
        
        <form class="form" id="profile-category-create-form">
            <div class="row form-group">
                <div class="col-5">
                    <select class="form-control" name="parent_id" id="">
                        <option value="">Основной раздел</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col">
                    <input class="form-control" name="name" type="text" placeholder="Название" autocomplete="off">
                </div>
            </div>

            <div class="row form-group">
                <div class="col">
                    <textarea class="form-control" name="description" placeholder="Описание" id="" cols="30" rows="4"></textarea>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Создать</button>
        </form>

    </x-profile.content>
</x-profile>