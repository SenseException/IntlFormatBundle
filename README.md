# IntlFormatBundle

A Symfony bundle of the [Intl-Format wrapper library](https://github.com/SenseException/intl-format) for PHP intl messages.
This bundle is currently in development and might introduce BC breaks.

[![Latest Stable Version](http://poser.pugx.org/senseexception/intl-format-bundle/v)](https://packagist.org/packages/senseexception/intl-format-bundle)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/senseexception/intl-format-bundle.svg)](https://packagist.org/packages/senseexception/intl-format-bundle)
[![Tests](https://github.com/SenseException/IntlFormatBundle/actions/workflows/tests.yml/badge.svg)](https://github.com/SenseException/IntlFormatBundle/actions/workflows/tests.yml)
[![Static Analysis](https://github.com/SenseException/IntlFormatBundle/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/SenseException/IntlFormatBundle/actions/workflows/static-analysis.yml)
[![License](http://poser.pugx.org/senseexception/intl-format-bundle/license)](https://packagist.org/packages/senseexception/intl-format-bundle)

## Installation

You can install it with [Composer](https://getcomposer.org/).

```
composer require senseexception/intl-format-bundle
```

If the composer installation with symfony/flex didn't already register the bundle, you need to register it into your
bundles.php manually:

``` php
return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Budgegeria\Bundle\IntlFormatBundle\BudgegeriaIntlFormatBundle::class => ['all' => true],
    // ...
];
```

## Configuration

By default a configuration doesn't need to be added if the needed locale is `en_US` and `USD` the currency. For any other
locale or currency you can add the following configuration to your project and configure the needed locale and currency
values:

``` yaml
budgegeria_intl_format:
  locale: 'de_DE'
  currency: 'EUR'
```

## Usage

IntlFormatBundle implements the functionality of [Intl-Format](http://senseexception.github.io/intl-format) and provides
Twig extensions for using the documented type specifiers of the library.

### Filters

Internationalization text formatting:
``` twig
{{ "This is the %ordinal time that the number %integer appear"|intl_format(4, 6000) }}
{# This is the 4th time that the number 6.000 appear #}
```

### Functions

Internationalization text formatting:
``` twig
{{ intl_format("This is the %ordinal time that the number %integer appear", 4, 6000) }}
{# This is the 4th time that the number 6.000 appear #}
```

Currency symbol of configured locale:
``` twig
{{ currency_symbol() }}
{# € #}
```
