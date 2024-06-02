# Запуск приложения на локальном хосте:
# 1 Установить зависимости - composer install
# 2 Собрать docker-контейнер (может потребоваться vpn) - ./vendor/bin/sail up -d
# 3 Выполнить миграцию - ./vendor/bin/sail artisan migrate
# 4 Запустить сервер-разработки - php artisan serv 
# 5 Перейти по адресу http://127.0.0.1:8000