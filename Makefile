.SILENT:

DB_USER?=root
DB_PASS?=root
DB_SCHEMA?=desafio

DIR_BACKUP?=${PWD}/storage/app
NOW?= `date +"%Y%m%d_%H%M%S"`


#------------------------------------------------------------------
# Run all configurations on server environment
#------------------------------------------------------------------
setup: update_repo install_composer db_create db_migrate permission_folders

#------------------------------------------------------------------
# Make all configurations
#------------------------------------------------------------------
setup_local: install_composer db_create db_migrate db_populate


#------------------------------------------------------------------
# Run all updates
#------------------------------------------------------------------
update: db_backup update_repo update_composer db_migrate artisans


#Permission Folders
permission_folders:
	# sudo chown -R nginx:nginx public
	sudo chmod -R 775 public
	sudo chmod -R 775 bootstrap/cache
	sudo chmod -R 775 bootstrap/cache
	# sudo chown -R nginx:nginx storage && sudo chmod -R 777 storage


#------------------------------------------------------------------
# Init webserver
#------------------------------------------------------------------
server:
	php artisan serve --port=8000 > /dev/null 2>&1 & echo 'Server Created in <http://localhost:8000>'

server_stop:
	kill `(lsof -t -i:8000)` & echo 'Server Stopped!'
	
#------------------------------------------------------------------		
# Config udate package from composer
#------------------------------------------------------------------
install_composer:
	rm -rf composer.lock
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install

#------------------------------------------------------------------		
# Config udate package from composer
#------------------------------------------------------------------
update_composer:
	sudo php composer.phar update
	
#------------------------------------------------------------------		
# Generate key artisan
#------------------------------------------------------------------
artisan_generatekey:
	sudo touch .env
	sudo php artisan key:generate

#------------------------------------------------------------------		
# Updating composer autoloader
#------------------------------------------------------------------
autoload_composer:
	php composer.phar dump-autoload
	
db_backup:
	mysqldump -u${DB_USER} -p${DB_PASS} -B ${DB_SCHEMA} > ${DIR_BACKUP}/${DB_SCHEMA}_${NOW}.sql

#------------------------------------------------------------------
# Create Database
#------------------------------------------------------------------
db_create:
	mysql -u${DB_USER} -p${DB_PASS} -e "create schema if not exists ${DB_SCHEMA};"
	
#------------------------------------------------------------------
# Create Database
#------------------------------------------------------------------
db_delete:
	mysql -u${DB_USER} -p${DB_PASS} -e "drop schema if exists ${DB_SCHEMA};"


#------------------------------------------------------------------
# Run All Migrations Reload Setup 
#------------------------------------------------------------------
db_reload: db_reset db_migrate db_populate

#------------------------------------------------------------------
# Run All Migrations Reload Setup with force
#------------------------------------------------------------------
db_reload_force: db_delete db_create db_migrate db_populate

db_reload_force_qa:
	mysql -u${DB_USER_QA} -p${DB_PASS_QA} -e "drop schema if exists ${DB_SCHEMA};"
	mysql -u${DB_USER_QA} -p${DB_PASS_QA} -e "create schema if not exists ${DB_SCHEMA};"
	php artisan migrate
	php artisan db:seed
		
#------------------------------------------------------------------
# Run Migrate
#------------------------------------------------------------------
db_migrate:
	php artisan migrate
	
#------------------------------------------------------------------
# Run Migrate Reset
#------------------------------------------------------------------
db_reset:
	php artisan migrate:reset
	
#------------------------------------------------------------------
# Run Migrate Rollback
#------------------------------------------------------------------
db_rollback:
	php artisan migrate:rollback

#------------------------------------------------------------------
# Run Migrate Rollback
#------------------------------------------------------------------
db_populate:
	php artisan db:seed


#------------------------------------------------------------------
# Show Routes List
#------------------------------------------------------------------
routes:
	php artisan rout:list	

#------------------------------------------------------------------
# Clear Cache
#------------------------------------------------------------------
cache_clear:
	php artisan config:clear

classloader: autoload_composer
	 php artisan optimize
	
clear: 
	php artisan config:cache
	php artisan cache:clear
	php artisan view:clear
	make classloader