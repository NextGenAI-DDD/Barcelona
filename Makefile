start:
	docker compose start

stop:
	docker compose down

restart:
	docker compose restart

build:
	docker compose up --build -d

exec:
	docker compose exec barcelona bash

down:
	docker compose down
