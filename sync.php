#!/service/local/apache/bin/php

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
		'url' => 'git://github.com/doctrine/mongodb.git'),
	'doctrine-dbal' => array(
		'url' => 'git://github.com/doctrine/dbal.git',
		'version' => '2.0.4'),
	'doctrine-migrations' => array(
		'url' => 'git://github.com/doctrine/migrations.git'),
	'doctrine-extension' => array(
		'url' => 'git://github.com/l3pp4rd/DoctrineExtensions.git'),
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
		'url' => 'git://github.com/symfony/symfony.git'),

	// Node.js
	'node' => array(
		'url' => 'https://github.com/joyent/node.git',
		'path' => 'node/node'),

	'npm' => array(
		'url' => 'http://github.com/isaacs/npm.git',
		'path' => 'node/npm'),

	// Bundles
	'frameworkextra' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => 'bundles/Sensio/Bundle/FrameworkExtraBundle'),
	'doctrine-mongodb-bundle' => array(
		'url' => 'git://github.com/symfony/DoctrineMongoDBBundle.git',
		'path' => 'bundles/Symfony/Bundle/DoctrineMongoDBBundle'),
	'jms-security-extra-bundle' => array(
		'url' => 'git://github.com/schmittjoh/SecurityExtraBundle.git',
		'path' => 'bundles/JMS/SecurityExtraBundle'),

	// css and javascript
/*	'blueprint-less' => array(
		'url' => 'git://github.com/sensio/SensioFrameworkExtraBundle.git',
		'path' => '_css/blueprint-less'), */
);


$yumInstall = array(
	'open-ssl-devel', 	// Node.js
);

$installPath = '/home/dtee/symfony/vendor/';
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
		$directoryPath = $installPath . $key;
	}

	if (is_dir($directoryPath))
	{
		echo "Target: {$key}, " . $directoryPath . " exists\n";
	}
	else
	{
		echo "Target: " . $directoryPath . "\n";
		$clone = "git clone {$info['url']} {$directoryPath}";
		exec($clone);
	}
}