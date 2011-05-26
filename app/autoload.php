<?php
$vendorPath = __DIR__ . '/..';
use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(
		$vendorPath . '/vendor/symfony/src',
		$vendorPath . '/vendor/bundles',),

    'Sensio'           => $vendorPath . '/vendor/bundles',
    'JMS'              => $vendorPath . '/vendor/bundles',
    'Monolog'          => $vendorPath . '/vendor/monolog/src',
    'Assetic'          => $vendorPath . '/vendor/assetic/src',

	# Doctrine
	'Gedmo'				=> $vendorPath . '/vendor/doctrine-extension/lib',
    'Doctrine'			=> $vendorPath . '/vendor/doctrine-extension/vendor/doctrine-orm/lib',
    'Doctrine\\DBAL'	=> $vendorPath . '/vendor/doctrine-extension/vendor/doctrine-dbal/lib',

	'Doctrine\\ODM'		=> $vendorPath . '/vendor/doctrine-mongodb-odm/lib',
	'Doctrine\\MongoDB'	=> $vendorPath . '/vendor/doctrine-mongodb-odm/lib/vendor/doctrine-mongodb/lib',
    'Doctrine\\Common'	=> $vendorPath . '/vendor/doctrine-mongodb-odm/lib/vendor/doctrine-common/lib',

	# DataFixtures ...
	'Doctrine\\Common\\DataFixtures' => $vendorPath . '/vendor/doctrine-fixtures/lib',

	// Bundles
	'Dtc'				=> __DIR__.'/../src',
	'Odl'				=> __DIR__.'/../src',
	'Grid'			    => $vendorPath . '/src/Acme',
	'FOS' 				=> $vendorPath . '/vendor/bundles',
	'Stof' 				=> $vendorPath . '/vendor/bundles',
));

$loader->registerPrefixes(array(
    'Twig_Extensions_' => $vendorPath . '/vendor/twig-extensions/lib',
    'Twig_'            => array(
		$vendorPath . '/vendor/twig_extension/lib',
		$vendorPath . '/vendor/twig/lib',),
    'Swift_'           => $vendorPath . '/vendor/swiftmailer/lib/classes',
));

$loader->registerPrefixFallback(array(
    $vendorPath . '/vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
	$vendorPath . '/vendor/twig_extension/lib',
));
$loader->register();

$oneOffs = array(
	'lessc/lessc.inc.php',
	//'facebook/src/facebook.php',
);

foreach ($oneOffs as $fileName)
{
	$fileName = $vendorPath . '/vendor/' . $fileName;
	require_once($fileName);
}

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 1);

require_once(__DIR__ . '/functions.php');
