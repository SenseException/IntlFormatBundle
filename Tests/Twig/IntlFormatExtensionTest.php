<?php

namespace Budgegeria\Bundle\IntlFormatBundle\Tests\Twig;

use Budgegeria\Bundle\IntlFormatBundle\Twig\IntlFormatExtension;
use Budgegeria\IntlFormat\Factory;

class IntlFormatExtensionTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new IntlFormatExtension((new Factory())->createIntlFormat('de_DE')),
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
