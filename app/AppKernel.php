<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),

			# Doctrine
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            // Handle assets
            // new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            //new Acme\FacebookBundle\FacebookBundle(),
            //new Acme\DemoBundle\AcmeDemoBundle(),

            # FOS Bundles
            new FOS\UserBundle\FOSUserBundle(),
            new FOS\FacebookBundle\FOSFacebookBundle(),
            // new FOS\TwitterBundle\FOSTwitterBundle(),

            # Odl bundles
            new Dtc\GridBundle\DtcGridBundle(),
            new Odl\AssetBundle\OdlAssetBundle(),
            new Odl\AuthBundle\OdlAuthBundle(),
            new Odl\ShadowBundle\ShadowBundle(),
            new Odl\PlacesBundle\OdlPlacesBundle(),
            new Odl\MarketplaceBundle\OdlMarketplaceBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    protected function initializeContainer() {
        parent::initializeContainer();

        $container = $this->container;
        $domain = $container->getParameter('root_domain');
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;

        if ($host && !endsWith($host, $domain)) {
            $url = 'http://' . $domain;
            $response = new RedirectResponse($url);
            $response->send();
            exit();
        }
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $host = $_SERVER['HTTP_HOST'];
        // Load setttings
        $files = explode('.', $host);
        $finder = new Finder();
        $configDir = __DIR__ . '/env';
        $finder->in($configDir);
        foreach ($files as $file) {
            $finder->name("*{$file}*.yml");
        }

        if (count($finder) == 0) {
            throw new \Exception('Env file not found.');
        }

        $config = array();
        foreach ($finder as $file) {
            $fileName = $file->getRealPath();
            $loader->load($fileName);
            break;
        }

        $this->envParams = $config;
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function getCacheDir()
    {
        return '/tmp/symfony-cache/'. $this->environment;
    }

    public function getLogDir()
    {
        return '/service/logs';
    }
}
