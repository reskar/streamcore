.PHONY: up down restart logs sh ci

up:
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose restart app

logs:
	docker compose logs -f app

sh:
	docker compose exec app sh

ci:
	composer ci
