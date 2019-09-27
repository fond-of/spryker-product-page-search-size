# Extend Spryker Category-Page-Search Module
[![Build Status](https://travis-ci.org/fond-of/spryker-category.svg?branch=master)](https://travis-ci.org/fond-of/product-page-search-size)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/product-page-search-size)

Set size in search results of elasticsearch

## Installation

```
composer require fond-of-spryker/product-page-search-style-key
```

After that register the new Plugin into your ProductPageSearchDependencyProvider

```
protected function getMapExpanderPlugins()
    {
        // ...
        $mapExpanderPlugins[] = new SizePageMapExpanderPlugin();
        // ...

        return $mapExpanderPlugins;
    }
