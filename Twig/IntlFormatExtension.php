<?php

namespace Budgegeria\Bundle\IntlFormatBundle\Twig;

use Budgegeria\IntlFormat\IntlFormat;
use Twig_Extension;
use Twig_SimpleFilter;

class IntlFormatExtension extends Twig_Extension
{
    /**
     * @var IntlFormat
     */
    private $intlFormat;

    /**
     * @param IntlFormat $intlFormat
     */
    public function __construct(IntlFormat $intlFormat)
    {
        $this->intlFormat = $intlFormat;
    }

    /**
     * @return Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('intl_format', [$this->intlFormat, 'format']),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intl_format_extension';
    }
}