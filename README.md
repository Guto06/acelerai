### Clone o projeto e execute

Comandos para inicializar o projeto (via docker):

```bash
cp .env.example .env
docker compose up -d
docker exec -it laravel-acelerai /bin/bash
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
php artisan migrate
php artisan serve
```