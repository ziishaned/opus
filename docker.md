# Docker documentation

## Install procedure

### 1 - Edit your `.env` file and your `docker-compose.yml` file to have the same passwords :

.env :
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=opus
DB_USERNAME=opus
DB_PASSWORD=change_this_user_password
```

docker-compose.yml :
```
- MYSQL_ROOT_PASSWORD=change_this_root_password
- MYSQL_DATABASE=opus
- MYSQL_USER=opus
- MYSQL_PASSWORD=change_this_user_password
```

### 2 - Build the container and install composer dependencies :
```
docker-compose build app
docker run -v "$PWD":/var/www/ opus_app /usr/local/bin/composer install
```

### 3 -Start the containers
```
docker-compose up -d
```

### 4 - Run the artisan scripts
```
docker-compose exec app php artisan migrate
docker-compose exec app php artisan key:generate
```
