<?php

declare(strict_types=1);

namespace Budgegeria\Bundle\IntlFormatBundle\Tests\Twig;

use Budgegeria\Bundle\IntlFormatBundle\Twig\IntlFormatterExtension;
use Budgegeria\IntlFormat\Factory;
use Twig\Test\IntegrationTestCase;

class IntlFormatterExtensionTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new IntlFormatterExtension((new Factory())->createIntlFormat('de_DE')),
        ];
    }

    /**
     * @return string
     */
    protected function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}