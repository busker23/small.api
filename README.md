Как разворачивать:
1. Склонировать из репозитория
2. В корне склонированного проекта из консольной команды установить необходимые настройки:
    - composer install
    - php artisan key:generate
    - php artisan migrate --seed
    - touch .env && cp .env.example .env
3. Запустить миграции и необходимый сид:
    - php artisan migrate --seed
4. php artisan serve
 
