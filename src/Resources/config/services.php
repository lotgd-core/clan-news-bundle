<?php

/**
 * This file is part of "LoTGD Bundle Clan News".
 *
 * @see https://github.com/lotgd-core/clan-news-bundle
 *
 * @license https://github.com/lotgd-core/clan-news-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lotgd\Bundle\ClanNewsBundle\EventSubscriber\ClanNewsSubscriber;

return static function (ContainerConfigurator $container)
{
    $container->services()
        //-- Event Subscribers
        ->set(ClanNewsSubscriber::class)
            ->args([
                new ReferenceConfigurator('doctrine.orm.entity_manager'),
                new ReferenceConfigurator('parameter_bag')
            ])
            ->tag('kernel.event_subscriber')
    ;
};
