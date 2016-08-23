<?php

namespace Budgegeria\Bundle\IntlFormatBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FormatterPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('intl_format.sprintf')) {
            return;
        }

        $sprintfDefinition = $container->findDefinition('intl_format.sprintf');
        $formatterTags = $container->findTaggedServiceIds('intl_format.formatter');

        foreach ($formatterTags as $id => $tagAttributes) {
            $sprintfDefinition->addMethodCall('addFormatter', [new Reference($id)]);
        }
    }
}