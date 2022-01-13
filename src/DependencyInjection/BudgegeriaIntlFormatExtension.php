<?php

declare(strict_types=1);

namespace Budgegeria\Bundle\IntlFormatBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class BudgegeriaIntlFormatExtension extends Extension
{
    /**
     * @param mixed[]          $configs
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        /** @phpstan-var array{locale: string, currency: string} $config */
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('budgegeria_intl_format.locale', $config['locale']);
        $container->setParameter('budgegeria_intl_format.currency', $config['currency']);
    }
}
