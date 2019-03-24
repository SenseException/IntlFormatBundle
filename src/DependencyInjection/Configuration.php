<?php

declare(strict_types = 1);

namespace Budgegeria\Bundle\IntlFormatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('budgegeria_intl_format');

        $treeBuilder->getRootNode()
            ->children()
                ->children()
                    ->scalarNode('locale')->end()
                    ->scalarNode('currency')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}