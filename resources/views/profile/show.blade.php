<x-profile.layout 
    title="Профиль">

    <p><b>Логин</b>: {{ $user->username }}</p>
    <p><b>Полное имя</b>: {{ $user->fullname }}</p>
    <p class="text-muted">Дата регистрации: {{ $user->created_at }}</p>
    <hr />
    <a href="{{ route('profile.edit') }}">Редактировать</a>
</x-profile.layout>