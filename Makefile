include ../Makefile.common

IMG_PATH = /service/img/a/symfony

all: install

install: path-install cache-install asset-install

asset-install:
	app/console assets:install --symlink web
	if  test -d $(IMG_PATH); then app/console assets:install --symlink $(IMG_PATH); fi
	
path-install: 
	test -d vendor || ln -s $(SERVICE_DEST)/local/apache/lib/php/vendor vendor

cache-install:	
	test -d /tmp/symfony-cache || mkdir /tmp/symfony-cache
	sudo chmod 777 /tmp/symfony-cache -R
	sudo chmod 777 /service/logs -R
	./bin/build_bootstrap.php
	
clean: 
	sudo rm -rf /tmp/symfony-cache 

reset: clean cache-install
