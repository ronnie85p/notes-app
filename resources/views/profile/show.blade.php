<x-profile title="Профиль">
    <div class="h4 mb-3">Ваши регистрационные данные</div>

    <p>{{ $user->fullname}}</p>
    <p>{{ $user->email }}</p>
    <hr>
    <p>Дата регистрации: {{ $user->created_at }}</p>
</x-profile>