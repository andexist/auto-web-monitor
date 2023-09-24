# auto-web-monitor
AutoWebMonitor - generates urls and extraxts url data

## How to use the App

1. **Build the app** using: *make build* or *docker-compose build*
1. **Run the app** using: *make upd* or *docker-compose up -d*
1. **Migrate tables** using: *make migrate* or *docker-compose -p=autowebmonitor exec autowebmonitor php bin/console doctrine:migrations:migrate -n*
1. **Connect to cotainer** using: *make bash* or *docker exec -it autowebmonitor bin/bash*
1. **Run unit test** using: *make phpunit* or *docker-compose -p=autowebmonitor exec autowebmonitor vendor/bin/phpunit*
1. **Stop the app** using: *make down* or *docker-compose down*