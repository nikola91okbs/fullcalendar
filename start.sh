#	commands in the docker container

#	loading vendor and migrating the database

	#	probably already installed
apt install -y composer

composer install
php artisan migrate

#	permissions
chown -R www-data:www-data /var/www
sudo usermod -a -G www-data root
