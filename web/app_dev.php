<?php
$vendorPath = __DIR__ . '/..';
if (isset($libdir))
{
	$vendorPath = $libdir;
}

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it, or make something more sophisticated.
require_once $vendorPath . '/vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/AppKernel.php';

use Symfony\Component\HttpFoundation\Request;
$kernel = new AppKernel('dev', true);
$kernel->handle(Request::createFromGlobals())->send();
