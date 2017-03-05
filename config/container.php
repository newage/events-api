<?php

use Aura\Di\ContainerBuilder;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$builder = new ContainerBuilder();
$container = $builder->newInstance();

// Inject config
$container->set('config', $config);
$container->set(
    Common\Container\ConfigInterface::class,
    $container->lazyNew(Common\Container\Config::class, [$config])
);

$container->set(Common\Container\Version::class, $container->lazyNew(Common\Container\Version::class));
$container->set(
    Common\Action\VersionMiddleware::class,
    $container->lazyNew(
        Common\Action\VersionMiddleware::class,
        [$container->lazyGet(\Common\Container\Version::class)]
    )
);

// Inject factories
foreach ($config['dependencies']['factories'] as $name => $object) {
    $container->set($object, $container->lazyNew($object));
    $container->set($name, $container->lazyGetCall($object, '__invoke', $container));
}

// Inject invokables
foreach ($config['dependencies']['invokables'] as $name => $object) {
    $container->set($name, $container->lazyNew($object));
}

return $container;
