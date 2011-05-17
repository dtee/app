include ../Makefile.common

all: install

install:
	ln -s $(SERVICE_DEST)/local/apache/lib/php/vendor vendor

clean: 
	rm -rf vendor
	rm -rf install
