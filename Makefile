DB := 'Application/Database/Maestria.db'
SQL := 'Application/Database/maestria.sql'

db-reset:
	if [ -f $(DB) ]; then rm -f $(DB); else echo "Database not exist yet"; fi;

db-install:
	if [ -f $(DB) ]; then echo "Hello"; else sqlite3 $(DB) < $(SQL); fi;

db:
	make db-reset
	make db-install

update:
	git pull -u origin master
	composer update
