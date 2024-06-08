dev:
	docker run --rm -itv $(shell pwd):/app -w /app composer:2.7.2 composer install --no-scripts --ignore-platform-reqs
	docker compose up -d
stop:
	docker compose down
refresh: stop dev
analyze:
	docker compose exec app php vendor/bin/rector --dry-run
refactor:
	docker compose exec app php vendor/bin/rector