<?php

declare(strict_types=1);

namespace Budgegeria\Bundle\IntlFormatBundle\Tests\Twig;

use Budgegeria\Bundle\IntlFormatBundle\Twig\IntlFormatterExtension;
use Budgegeria\IntlFormat\Factory;
use Override;
use Twig\Test\IntegrationTestCase;

class IntlFormatterExtensionTest extends IntegrationTestCase
{
    #[Override]
    public function getExtensions()
    {
        return [
            new IntlFormatterExtension((new Factory())->createIntlFormat('de_DE'), 'EUR'),
        ];
    }

    /**
     * @return string
     */
    #[Override]
    protected function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
