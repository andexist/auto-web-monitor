# auto-web-monitor
AutoWebMonitor - generates urls and extraxts url data

## How to use the App

1. **Build the app** *RUN*: <em>**make build**</em> or **docker-compose build**</em>
1. **Run the app** *RUN*: <em>**make upd**</em> or <em>**docker-compose up -d**</em>
1. **Migrate tables** *RUN*: <em>**make migrate**</em> or <em>**docker-compose -p=autowebmonitor exec autowebmonitor php bin/console doctrine:migrations:migrate -n**</em>
1. **Connect to cotainer** *RUN*: <em>**make bash**</em> or <em>**docker exec -it autowebmonitor bin/bash**</em>
1. **Run unit test** *RUN*: <em>**make phpunit**</em> or <em>**docker-compose -p=autowebmonitor exec autowebmonitor vendor/bin/phpunit**</em>
1. **Stop the app** *RUN*: <em>**make down**</em> or <em>**docker-compose down**</em>