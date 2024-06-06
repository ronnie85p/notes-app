<x-profile.layout>
    <x-slot:title>Профиль</x-slot:title>

    <p><b>Логин</b>: {{ $user->username }}</p>
    <p><b>Полное имя</b>: {{ $user->fullname }}</p>
    <a href="{{ route('profile.edit') }}">Редактировать</a>
    <hr />
    
    <p class="text-muted">Дата регистрации: {{ $user->created_at }}</p>
</x-profile.layout>