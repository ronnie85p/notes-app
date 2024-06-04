<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('profile.show') }}" class="{{ $active == 'profile.show' ? 'fw-bolder' : '' }}">Профиль</a>
        <a href="{{ route('profile.edit') }}" class="float-end text-muted"><small>ред.</small></a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('profile.editpassword') }}" class="{{ $active == 'profile.editpassword' ? 'fw-bolder' : '' }}">Изменить пароль</a>
    </li>
    <li class="list-group-item">
        <a href="#" class="text-danger">Удалить профиль</a>
    </li>
</ul>