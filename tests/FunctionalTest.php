<?php

declare(strict_types = 1);

namespace Budgegeria\Bundle\IntlFormatBundle\Tests;

use Budgegeria\Bundle\IntlFormatBundle\BudgegeriaIntlFormatBundle;
use Budgegeria\Bundle\IntlFormatBundle\DependencyInjection\BudgegeriaIntlFormatExtension;
use Budgegeria\IntlFormat\IntlFormat;
use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class FunctionalTest extends TestCase
{
    public function testServices()
    {
        $container = $this->createContainer();

        $intlFormat = $container->get(IntlFormat::class);

        $date = new DateTime();
        $date->setDate(2016, 3, 1);
        $date->setTime(5, 30);
        $date->setTimezone(new DateTimeZone('US/Arizona'));

        self::assertSame('Today is 3/1/16', $intlFormat->format('Today is %date_short', $date));
        self::assertSame('I got 1,002.25 as average value', $intlFormat->format('I got %number as average value', 1002.25));
        self::assertSame('I got 1,002.2500 as average value', $intlFormat->format('I got %.4number as average value', 1002.25));
        self::assertSame('I is 5:30 AM on my clock.', $intlFormat->format('I is %time_short on my clock.', $date));
        self::assertSame('The timezone id is US/Arizona.', $intlFormat->format('The timezone id is %timeseries_id.', $date));
        self::assertSame('I am from Italy.', $intlFormat->format('I am from %region.', 'it_IT'));
        self::assertSame('You have 10$.', $intlFormat->format('You have 10%currency_symbol.', ''));
    }

    private function createContainer() : ContainerBuilder
    {
        $mappings = [
            'BudgegeriaIntlFormatBundle' => BudgegeriaIntlFormatBundle::class,
        ];

        $containerBuilder = new ContainerBuilder(new ParameterBag([
            'kernel.debug'       => false,
            'kernel.bundles'     => $mappings,
            'kernel.environment' => 'test',
            'kernel.root_dir'    => __DIR__.'/../',
            'kernel.name'        => 'test',
            'kernel.cache_dir'   => sys_get_temp_dir(),
        ]));

        $extension = new BudgegeriaIntlFormatExtension();
        $containerBuilder->registerExtension($extension);
        $extension->load([
            'budgegeria_intl_format' => [
                'locale' => 'en_US',
                'currency' => 'USD'
            ]
        ], $containerBuilder);

        $containerBuilder->getDefinition(IntlFormat::class)->setPublic(true);

        $containerBuilder->compile();

        return $containerBuilder;
    }
}