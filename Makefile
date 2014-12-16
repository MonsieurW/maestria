DB := 'Application/Database/Maestria.db'
DBD := 'Application/Database'
SQL := 'Application/Database/maestria.sql'
VENDOR := 'vendor'
COMPOSER := $(shell if [ `which composer` ]; then echo 'composer'; else curl -sS https://getcomposer.org/installer | php > /dev/null 2>&1 ; echo './composer.phar'; fi;)

db-reset:
	if [ -f $(DB) ]; then rm -f $(DB); else echo "Database not exist yet"; fi;

db-install:
	sqlite3 $(DB) < $(SQL)
	chmod 0777 -R $(DBD)
	chmod +x Binaries/sohoa
	chmod +x Binaries/hoa
	
db-peuplate:
	make db-data
	make db-sample

db-data:
	sqlite3 $(DB) < Application/Database/data.sql

db-sample:
	Binaries/sohoa application sample:data

db:
	make db-reset
	make db-install
	make db-data

db-update:
	sqlite3 $(DB) < Application/Database/update.1.sql

update:
	git pull -u origin master
	$(COMPOSER) update --no-dev
	make log

install:
	$(COMPOSER) install --no-dev
	make log

deploy:
	cap nightly deploy deploy:all

push:
	git add --all
	git commit -a -m "Update for push"
	git push
	make deploy

log:
	touch Application/Log/app.log
	chmod 0777 Application/Log/app.log

