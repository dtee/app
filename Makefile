include ../Makefile.common

all: install

install: path-install cache-install asset-install

asset-install:
	app/console assets:install --symlink web
	
path-install: 
	test -d vendor || ln -s $(SERVICE_DEST)/local/apache/lib/php/vendor vendor

cache-install:	
	test -d /tmp/symfony-cache || mkdir /tmp/symfony-cache
	sudo chmod 777 /tmp/symfony-cache -R
	sudo chmod 777 /service/logs -R
	
clean: 
	rm -rf vendor
	rm -rf install
	rm -rf /tmp/symfony-cache 
