### Clone o projeto e execute

Comandos para inicializar o projeto (via docker):

```bash
cp .env.example .env
docker compose up -d
docker exec -it laravel-acelerai /bin/bash
chown -R www-data:www-data /var/www/html/storage
composer update
npm i
php artisan migrate
npm run build
```