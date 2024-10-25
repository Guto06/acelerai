### Clone o projeto e execute

Comandos para inicializar o projeto (via docker):

```bash
cp .env.example .env
docker compose up -d
docker exec -it laravel-acelerai /bin/bash
chown -R www-data:www-data /var/www/html/storage
composer install
npm i
php artisan migrate
php artisan db:seed UserSeeder
npm run build
```