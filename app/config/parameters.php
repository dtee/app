<?php
global $context;

if ($context) {
    $config = $context->getResources()->getConfig();

    $container->set('odl.context', $context);
    $container->set('odl.resources', $context->getResources());
    $container->set('odl.resources.config', $config);

    // Register dbal connections
    $port = $config->getValue('globals', 'memcache_port');
    $hosts = $config->getValue('globals', 'memcache_machines');

    $databases = $config->getDatabaseConfig();
    if ($container->hasParameter('db_connections')) {
        $databases = array_merge($container->getParameter('db_connections'), $databases);
    }
    $container->setParameter('db_connections', $databases);

    // Register entity manager

    // Register mongodb connections
    $connections = $config->getMongoDBConnection();
    $mongoDBConnections = array();
    foreach ($connections as $key => $server) {
        $mongoDBConnections[$key] = array(
            'server' => $server,
            'options' => array(
                'connect' => true,
                'timeout' => 0,
                'persist' => true,
        		'connect' => true
            )
        );
    }

    if ($container->hasParameter('mongodb_connections')) {
        $mongoDBConnections = array_merge($container->getParameter('mongodb_connections'), $mongoDBConnections);
    }

    // We should only register connections that maps to Managers
    $managers = $container->getParameter('mongodb_managers');
    $managedConnections = array();
    foreach (array_keys($managers) as $connectionName) {
        if (isset($mongoDBConnections[$connectionName]))
            $managedConnections[$connectionName] = $mongoDBConnections[$connectionName];
    }

    $container->setParameter('mongodb_connections', $managedConnections);

    // Set services
    $container->set('odl.context', $context);
    $container->set('odl.resources', $context->getResources());
    $container->set('odl.resources.config', $config);
}