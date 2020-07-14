#	commands in the docker container

#	loading vendor and migrating the database

	#	probably already installed
apt install -y composer

composer install
cp .env.example .env
php artisan migrate

#	permissions
chown -R www-data:www-data /var/www
sudo usermod -a -G www-data root
