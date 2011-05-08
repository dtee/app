<?php
$gitRepositories = array(
	'assetic' => array(
		'url' => 'git://github.com/dtee/assetic.git',
		'main_url' => 'git://github.com/kriswallsmith/assetic.git'),
	'doctrine-common' => array(
		'url' => 'git://github.com/doctrine/common.git'),
	'doctrine-orm' => array(
		'url' => 'git://github.com/doctrine/doctrine2.git',
		'branch' => '2.0.4'),
	'doctrine-mongodb-odm' => array(
		'url' => 'git@github.com:dtee/mongodb-odm.git',
		'main_url' => 'git://github.com/doctrine/mongodb-odm.git'),
	'doctrine-mongodb' => array(
		'url' => 'git@github.com:dtee/mongodb-odm.git',
		'main_url' => 'git://github.com/doctrine/mongodb.git'),
	'doctrine-dbal' => array(
		'url' => 'git://github.com/doctrine/dbal.git',
		'branch' => '2.0.4'),
	'doctrine-migrations' => array(
		'url' => 'git://github.com/doctrine/migrations.git'),
	'doctrine-extension' => array(
		'url' => 'git://github.com/l3pp4rd/DoctrineExtensions.git'),
	'doctrine-fixtures' => array(
		'url' => 'https://github.com/doctrine/data-fixtures.git'),
	'monolog' => array(
		'url' => 'git://github.com/Seldaek/monolog.git'),
	'swiftmailer' => array(
		'url' => 'git://github.com/swiftmailer/swiftmailer.git',
		'branch' => 'origin/4.1'),
	'twig' => array(
		'url' => 'git://github.com/fabpot/Twig.git'),
	'facebook' => array(
		'url' => 'git://github.com/facebook/php-sdk.git'),
	'lessc' => array(
		'url' => 'git://github.com/leafo/lessphp.git'),
	'symfony' => array(
		'url' => 'git@github.com:dtee/symfony.git',
		'main_url' => 'git://github.com/symfony/symfony.git'),

/*	// Node.js
	'node' => array(
		'url' => 'https://github.com/joyent/node.git',
		'path' => 'vendor/node/node'),

	'npm' => array(
		'url' => 'http://github.com/isaacs/npm.git',
		'path' => 'vendor/node/npm'), */

	// Bundles
	'FrameworkExtraBundle' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => 'vendor/bundles/Sensio/Bundle/FrameworkExtraBundle'),
	'DoctrineMongoDBBundle' => array(
		'url' => 'git://github.com/symfony/DoctrineMongoDBBundle.git',
		'path' => 'vendor/bundles/Symfony/Bundle/DoctrineMongoDBBundle'),
	'SecurityExtraBundle' => array(
		'url' => 'git://github.com/schmittjoh/SecurityExtraBundle.git',
		'path' => 'vendor/bundles/JMS/SecurityExtraBundle'),
	'DoctrineFixturesBundle' => array(
		'url' => 'https://github.com/symfony/DoctrineFixturesBundle.git',
		'path' => 'vendor/bundles/Symfony/Bundle/DoctrineFixturesBundle'),

	// My bundles
	'asset' => array(
		'url' => 'git@github.com:dtee/asset.git',
		'path' => 'src/Odl/AssetBundle',
		'type' => 'src'),

	'auth' => array(
		'url' => 'git@github.com:dtee/auth.git',
		'path' => 'src/Odl/AuthBundle',
		'type' => 'src'),

	'shadow' => array(
		'url' => 'git@github.com:dtee/ShadowBundle.git',
		'path' => 'src/Odl/ShadowBundle',
		'type' => 'src'),

	// css and javascript
/*	'blueprint-less' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => '_css/blueprint-less'), */
);
