<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\TwitterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder
            ->root('endroid_twitter')
                ->children()
                    ->scalarNode('consumer_key')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('consumer_secret')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('access_token')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('access_token_secret')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('api_url')->defaultValue(null)->end()
                    ->scalarNode('proxy')->defaultValue(null)->end()
                    ->integerNode('timeout')->defaultValue(5)->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
