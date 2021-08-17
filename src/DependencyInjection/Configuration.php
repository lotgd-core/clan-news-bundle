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

namespace Lotgd\Bundle\ClanNewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('lotgd_clan_news');

        $treeBuilder->getRootNode()
            ->children()
                ->integerNode('max_news')
                    ->min(1)
                    ->max(25)
                    ->defaultValue(5)
                    ->info('Maximum number of news events to display.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
