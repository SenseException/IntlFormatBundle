<?php

declare(strict_types=1);

namespace Budgegeria\Bundle\IntlFormatBundle\Twig;

use Budgegeria\IntlFormat\IntlFormatInterface;
use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class IntlFormatterExtension extends AbstractExtension
{
    /**
     * @var IntlFormatInterface
     */
    private $intlFormat;

    /**
     * @var string
     */
    private $currency;

    public function __construct(IntlFormatInterface $intlFormat, string $currency)
    {
        $this->intlFormat = $intlFormat;
        $this->currency   = $currency;
    }

    #[Override]
    public function getFilters()
    {
        return [
            new TwigFilter('intl_format', [$this, 'format']),
        ];
    }

    #[Override]
    public function getFunctions()
    {
        return [
            new TwigFunction('intl_format', [$this, 'format']),
            new TwigFunction('currency_symbol', function () : string {
                return $this->intlFormat->format('%currency_symbol', $this->currency);
            }),
        ];
    }

    /**
     * @param string $message
     * @param mixed  ...$values
     *
     * @return string
     *
     * @throws \Budgegeria\IntlFormat\Exception\InvalidTypeSpecifierException
     */
    public function format(string $message, ...$values) : string
    {
        return $this->intlFormat->format($message, ...$values);
    }
}
