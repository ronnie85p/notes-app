# Запуск приложение на локальном хосте:
# 1) $ composer install (Установить зависимости)
# 2) $ ./vendor/bin/sail up -d (Собрать docker-контейнер (может потребоваться vpn))
# 3) $ ./vendor/bin/sail artisan migrate (Выполнить миграцию)
# 4) Заменить значение параметра DB_HOST в файле .env: mysql -> 127.0.0.1
# 5) $ php artisan serv (Запустить сервер-разработки) 
# 6) Перейти по адресу http://127.0.0.1:8000


