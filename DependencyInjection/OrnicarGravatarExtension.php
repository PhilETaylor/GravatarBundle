<?php

namespace Ornicar\GravatarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class OrnicarGravatarExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $configuration = new Configuration();
        $processor = new Processor();
        $config = $processor->process($configuration->getConfigTreeBuilder()->buildTree(), $configs);

        $container->getDefinition('gravatar.api')->addArgument($config);
    }
}
