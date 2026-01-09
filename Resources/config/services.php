<?php

declare(strict_types=1);

use Ornicar\GravatarBundle\GravatarApi;
use Ornicar\GravatarBundle\Templating\Helper\GravatarHelper;
use Ornicar\GravatarBundle\Twig\GravatarExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('gravatar.api', GravatarApi::class);

    $services->set('templating.helper.gravatar', GravatarHelper::class)
        ->tag('templating.helper', ['alias' => 'gravatar'])
        ->args([
            service('gravatar.api'),
            service('router'),
        ]);

    $services->set('twig.extension.gravatar', GravatarExtension::class)
        ->tag('twig.extension', ['alias' => 'gravatar'])
        ->args([
            service('templating.helper.gravatar'),
        ]);
};
