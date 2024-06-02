# Запуск приложение на локальном хосте:
# 1) $ composer install (Установить зависимости)
# 2) $ ./vendor/bin/sail up -d (Собрать docker-контейнер (может потребоваться vpn))
# 3) $ ./vendor/bin/sail artisan migrate (Выполнить миграцию)
# 4) Заменить значение параметра DB_HOST в файле .env: mysql -> 127.0.0.1
# 5) $ php artisan serv (Запустить сервер-разработки) 
# 6) Перейти по адресу http://127.0.0.1:8000

# Работа с приложением
# Для создания заметок требуется аутентификация. Нужна регистрация.
# После регистрации авто-входа в систему нет, вместо этого следует перенаправление на страницу входа.
# При работе с формами приложения (входа, регистрации, добавление/редактирование, а также удаления заметок) 
# уведомление ошибок только пользовательские, т.е. ошибки формы, полей.