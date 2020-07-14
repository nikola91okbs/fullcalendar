#	after git clone --recursive https://github.com/nikola91okbs/fullcalendar.git

#	configure laradock
cd laradock
cp env-example .env

# echo $(pwd)

#	install docker
sudo apt install docker
sudo apt install docker-compose

#	permissions for the project
chown -R www-data:www-data ../
usermod -a -G www-data root
chmod -R 777 ../
chown -R root:www-data ../
chgrp -R www-data ../
chmod -R ug+rwx ../

#	start docker containers
docker-compose up -d apache2 mysql phpmyadmin redis workspace

#	run project functions
docker-compose exec workspace bash /var/www/start.sh