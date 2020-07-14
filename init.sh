#	after git clone --recursive https://github.com/nikola91okbs/fullcalendar.git

#	install docker
sudo apt install docker
sudo apt install docker-compose

docker-compose up -d apache2 mysql phpmyadmin redis workspace

docker-compose exec bash /var/www/start.sh