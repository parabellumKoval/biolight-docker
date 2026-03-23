SHELL := /bin/sh

ENV_FILE ?= .env.docker
DOCKER_DATA_DIR ?= .docker/volumes
TAIL ?= 100
CMD ?= sh
FILE ?= dump.sql

-include $(ENV_FILE)

DEFAULT_MODE ?= prod
MODE ?= $(DEFAULT_MODE)

ifeq ($(MODE),dev)
COMPOSE_FILES := -f docker-compose.yml -f docker-compose.dev.yml
else
COMPOSE_FILES := -f docker-compose.yml -f docker-compose.prod.yml
export COMPOSE_PROFILES := prod
endif

COMPOSE := docker compose --env-file $(ENV_FILE) $(COMPOSE_FILES)
DUMP_DIR := $(DOCKER_DATA_DIR)/mysql/dumps

.PHONY: help setup up bup down stop start restart ps logs exec build db.dump db.import

help:
	@printf '%s\n' \
		'Targets:' \
		'  make setup' \
		'  make up MODE=dev|prod' \
		'  make bup MODE=dev|prod' \
		'  make down MODE=dev|prod' \
		'  make api.logs' \
		'  make api.exec CMD="php artisan tinker"' \
		'  make api.bup MODE=dev' \
		'  make db.dump FILE=backup.sql' \
		'  make db.import FILE=backup.sql' \
		'  Set DEFAULT_MODE in .env.docker to change the default make mode'

setup:
	@mkdir -p \
		$(DOCKER_DATA_DIR)/api/storage \
		$(DOCKER_DATA_DIR)/api/bootstrap-cache \
		$(DOCKER_DATA_DIR)/api/uploads \
		$(DOCKER_DATA_DIR)/mysql/data \
		$(DUMP_DIR)

up: setup
	$(COMPOSE) up -d

bup: setup
	$(COMPOSE) up -d --build

down:
	$(COMPOSE) down --remove-orphans

stop:
	$(COMPOSE) stop

start:
	$(COMPOSE) start

restart:
	$(COMPOSE) restart

ps:
	$(COMPOSE) ps

logs:
	$(COMPOSE) logs -f --tail=$(TAIL)

build: setup
	$(COMPOSE) build

%.up: setup
	$(COMPOSE) up -d $*

%.bup: setup
	$(COMPOSE) up -d --build $*

%.stop:
	$(COMPOSE) stop $*

%.start:
	$(COMPOSE) start $*

%.restart:
	$(COMPOSE) restart $*

%.build: setup
	$(COMPOSE) build $*

%.logs:
	$(COMPOSE) logs -f --tail=$(TAIL) $*

%.exec:
	$(COMPOSE) exec $* $(CMD)

db.dump: setup
	$(COMPOSE) exec -T mysql sh -lc 'mysqldump -u"$${MYSQL_USER}" -p"$${MYSQL_PASSWORD}" "$${MYSQL_DATABASE}"' > $(DUMP_DIR)/$(FILE)

db.import: setup
	$(COMPOSE) exec -T mysql sh -lc 'mysql -u"$${MYSQL_USER}" -p"$${MYSQL_PASSWORD}" "$${MYSQL_DATABASE}"' < $(DUMP_DIR)/$(FILE)

dev.up:
	$(MAKE) up MODE=dev

dev.bup:
	$(MAKE) bup MODE=dev

dev.down:
	$(MAKE) down MODE=dev

prod.up:
	$(MAKE) up MODE=prod

prod.bup:
	$(MAKE) bup MODE=prod

prod.down:
	$(MAKE) down MODE=prod
