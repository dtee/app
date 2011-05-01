#!/bin/sh

cd $(dirname $0)

# initialization
if [ "$1" = "--reinstall" ]; then
    rm -rf vendor
fi

mkdir -p vendor && cd vendor

##
# @param destination directory (e.g. "doctrine")
# @param URL of the git remote (e.g. git://github.com/doctrine/doctrine2.git)
# @param revision to point the head (e.g. origin/HEAD)
#
install_git()
{
    INSTALL_DIR=$1
    SOURCE_URL=$2
    REV=$3

    if [ -z $REV ]; then
        REV=origin/HEAD
    fi

    if [ ! -d $INSTALL_DIR ]; then
        git clone $SOURCE_URL $INSTALL_DIR
    fi

    cd $INSTALL_DIR
    git remote add $INSTALL_DIR $SOURCE_URL
    git fetch $INSTALL_DIR
    git reset --hard $REV
    cd ..
}

# Assetic
install_git assetic git://github.com/kriswallsmith/assetic.git

# Doctrine ORM
install_git doctrine-orm git://github.com/doctrine/doctrine2.git 2.0.4

# Doctrine ODM
install_git doctrine-odm git://github.com/doctrine/mongodb-odm.git

# Doctrine DBAL
install_git doctrine-dbal git://github.com/doctrine/dbal.git 2.0.4

# Doctrine Common
install_git doctrine-common git://github.com/doctrine/common.git 2.0.2

# Doctrine migrations
install_git doctrine-migrations git://github.com/doctrine/migrations.git

# Doctrine extension - Gedmo
install_git doctrine-extension git://github.com/l3pp4rd/DoctrineExtensions.git

# Monolog
install_git monolog git://github.com/Seldaek/monolog.git

# Swiftmailer
install_git swiftmailer git://github.com/swiftmailer/swiftmailer.git origin/4.1

# Twig
install_git twig git://github.com/fabpot/Twig.git

# Twig Extension - translation

# Facebook
install_git facebook git://github.com/facebook/php-sdk.git

# Less php css
install_git lessc git://github.com/leafo/lessphp.git

# Symfony 
install_git symfony git://github.com/symfony/symfony.git

#--------- Bundles ----------
# Symfony Extra
install_git frameworkextra git://github.com/henrikbjorn/FrameworkExtraBundle.git
install_git doctrine-mongodb-bundle git://github.com/symfony/DoctrineMongoDBBundle.git

# Facebook Bundle

#--------- CSS/Javascript ------
# jQuery

