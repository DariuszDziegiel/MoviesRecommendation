DC := docker compose
DC_EXEC := $(DC) exec -it apache
PHPUNIT := $(DC_EXEC) vendor/bin/phpunit --configuration phpunit.xml --colors=always --testdox

default: start

start:
	$(DC) up -d

stop:
	$(DC) stop

remove:
	$(DC) down -v

test:
	$(PHPUNIT) $(RUN_ARGS)
