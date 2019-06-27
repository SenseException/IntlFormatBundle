<?php

declare(strict_types = 1);

namespace Budgegeria\Bundle\IntlFormatBundle\Twig;

use Budgegeria\IntlFormat\IntlFormat;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class IntlFormatterExtension extends AbstractExtension
{
    /**
     * @var IntlFormat
     */
    private $intlFormat;

    public function __construct(IntlFormat $intlFormat)
    {
        $this->intlFormat = $intlFormat;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('intl_format', [$this, 'format']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('intl_format', [$this, 'format']),
        ];
    }

    public function format(string $message, ...$values) : string
    {
        return $this->intlFormat->format($message, ...$values);
    }
}
