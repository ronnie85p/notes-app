# Запуск приложения на локальном хосте
1) $ composer install (Установить зависимости)
2) $ ./vendor/bin/sail up -d (Собрать docker-контейнер (может потребоваться vpn))
3) $ ./vendor/bin/sail artisan migrate (Выполнить миграцию)
4) Заменить значение параметра DB_HOST в файле .env: mysql -> 127.0.0.1
5) $ php artisan serv (Запустить сервер-разработки) 
6) Перейти по адресу http://127.0.0.1:8000

# Работа с приложением
1) Для создания заметок требуется аутентификация (регистрация).
2) После регистрации следует перенаправление на страницу входа.
3) При работе с формами приложения (вход, регистрация, добавление/редактирование и удаления заметок) 
только пользовательские уведомление ошибок, т.е. ошибки формы, полей.