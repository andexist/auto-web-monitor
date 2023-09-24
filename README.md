# auto-web-monitor
AutoWebMonitor - generates urls and extraxts url data

## How to use the App

1. **Build the app** *run*: <code>**make build**</code> or <code>**docker-compose build**</code>
1. **Run the app** *run*: <code>**make upd**</code> or <code>**docker-compose up -d**</code>
1. **Migrate tables** *run*: <code>**make migrate**</code> or <code>**docker-compose -p=autowebmonitor exec autowebmonitor php bin/console doctrine:migrations:migrate -n**</code>
1. **Connect to cotainer** *run*: <code>**make bash**</code> or <code>**docker exec -it autowebmonitor bin/bash**</code>
1. **Run unit test** *run*: <code>**make phpunit**</code> or <code>**docker-compose -p=autowebmonitor exec autowebmonitor vendor/bin/phpunit**</emcode>
1. **Stop the app** *run*: <code>**make down**</code> or <code>**docker-compose down**</code>