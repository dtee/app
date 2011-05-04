#!/usr/bin/env php

<?php
$gitRepositories = array(
	'assetic' => array(
		'url' => 'git://github.com/dtee/assetic.git',
		'main_url' => 'git://github.com/kriswallsmith/assetic.git'),
	'doctrine-common' => array(
		'url' => 'git://github.com/doctrine/common.git'),
	'doctrine-orm' => array(
		'url' => 'git://github.com/doctrine/doctrine2.git',
		'version' => '2.0.4'),
	'doctrine-mongodb-odm' => array(
		'url' => 'git://github.com/doctrine/mongodb-odm.git'),
	'doctrine-mongodb' => array(
		'url' => 'git@github.com:dtee/mongodb-odm.git',
		'main_url' => 'git://github.com/doctrine/mongodb.git'),
	'doctrine-dbal' => array(
		'url' => 'git://github.com/doctrine/dbal.git',
		'version' => '2.0.4'),
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
		'version' => 'origin/4.1'),
	'twig' => array(
		'url' => 'git://github.com/fabpot/Twig.git'),
	'facebook' => array(
		'url' => 'git://github.com/facebook/php-sdk.git'),
	'lessc' => array(
		'url' => 'git://github.com/leafo/lessphp.git'),
	'symfony' => array(
		'url' => 'git@github.com:dtee/symfony.git',
		'upstream_url' => 'git://github.com/symfony/symfony.git'),

/*	// Node.js
	'node' => array(
		'url' => 'https://github.com/joyent/node.git',
		'path' => 'vendor/node/node'),

	'npm' => array(
		'url' => 'http://github.com/isaacs/npm.git',
		'path' => 'vendor/node/npm'), */

	// Bundles
	'frameworkextra' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => 'vendor/bundles/Sensio/Bundle/FrameworkExtraBundle'),
	'doctrine-mongodb-bundle' => array(
		'url' => 'git://github.com/symfony/DoctrineMongoDBBundle.git',
		'path' => 'vendor/bundles/Symfony/Bundle/DoctrineMongoDBBundle'),
	'jms-security-extra-bundle' => array(
		'url' => 'git://github.com/schmittjoh/SecurityExtraBundle.git',
		'path' => 'vendor/bundles/JMS/SecurityExtraBundle'),
	'DoctrineFixturesBundle' => array(
		'url' => 'https://github.com/symfony/DoctrineFixturesBundle.git',
		'path' => 'vendor/bundles/Symfony/Bundle/DoctrineFixturesBundle'),

	// My bundles
	'asset' => array(
		'url' => 'git@github.com:dtee/asset.git',
		'path' => 'src/Odl/AssetBundle'),
	'shadow' => array(
		'url' => 'git@github.com:dtee/ShadowBundle.git',
		'path' => 'src/Odl/ShadowBundle'),

	// css and javascript
/*	'blueprint-less' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => '_css/blueprint-less'), */
);

$yumInstall = array(
	'open-ssl-devel', 	// Node.js
);

$installPath =  __DIR__ . '/';
foreach ($gitRepositories as $key => $info)
{
	$version = 'origin/HEAD';
	if (isset($info['version']))
		$version = $info['version'];

	if (isset($info['path']))
	{
		$directoryPath = $installPath . $info['path'];
	}
	else
	{
		$directoryPath = $installPath . 'vendor/' . $key;
	}

	if (is_dir($directoryPath))
	{
		// Do we upgrade??
		echo "Target: {$key}, " . $directoryPath . " exists\n";
		//$command = "git pull";
		//echo exec($command);
		
		// Make sure the target url is still the same.
		echo exec("cd {$directoryPath}");
		echo exec("pwd");
		echo exec("git remote rm origin");
		echo exec("git remote rm upstream");
		echo exec("git remote add origin {$info['url']}");
		
		if (isset($info['main_url']))
		{
			echo exec("git remote add upstream {$info['main_url']}"); 
		}
	}
	else
	{
		echo "Target: " . $directoryPath . "\n";
		$clone = "git clone {$info['url']} {$directoryPath}";
		echo $clone . "\n";
		echo exec($clone) . "\n";
		
		if (isset($info['version']))
		{
			echo exec("cd {$directoryPath}");
			$command = "git reset --hard {$info['version']}";
			echo $command;
			echo exec($command);
		}
	}
	
	echo exec("cd {$installPath}");
}