#	commands in the docker container

#	loading vendor and migrating the database

	#	probably already installed
apt install -y composer

cp .env.example .env
composer install

php artisan config:clear
php artisan cache:clear

php artisan migrate:fresh

#	permissions
# chown -R www-data:www-data /var/www
# usermod -a -G www-data root
# chown -R 777 /var/www
