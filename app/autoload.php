<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(
		__DIR__.'/../vendor/symfony/src',
		__DIR__.'/../vendor/bundles',),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine-orm/lib',
	'Doctrine\\ODM'	   => __DIR__.'/../vendor/doctrine-mongodb-odm/lib',
	'Doctrine\\MongoDB'	   => __DIR__.'/../vendor/doctrine-mongodb/lib',
	'Gedmo'			   => __DIR__.'/../vendor/doctrine-extension/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Acme'             => __DIR__.'/../src',
	'Odl'				=> __DIR__.'/../src',
	'Grid'			    => __DIR__.'/../src/Acme',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'Swift_'           => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
$loader->registerPrefixFallback(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
));

$oneOffs = array(
	'lessc/lessc.inc.php',
	'facebook/src/facebook.php',
);

foreach ($oneOffs as $fileName)
{
	$fileName = __DIR__ . '/../vendor/' . $fileName;
	require_once($fileName);
}

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 1);

require_once(__DIR__ . '/functions.php');
