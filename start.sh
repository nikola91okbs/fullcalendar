#	commands in the docker container

#	loading vendor and migrating the database

	#	probably already installed
apt install -y composer

cp .env.example .env
composer install

#	maintaince mode
php artisan down

php artisan config:clear
php artisan cache:clear

php artisan migrate

#	production mode
php artisan up