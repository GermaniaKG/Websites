# Germania KG · Websites

**This package was destilled from legacy code and is deprecated.*   
You better do not want it to use this in production.

[![Packagist](https://img.shields.io/packagist/v/germania-kg/websites.svg?style=flat)](https://packagist.org/packages/germania-kg/websites)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/websites.svg)](https://packagist.org/packages/germania-kg/websites)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Websites.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Websites)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Websites/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Websites/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Websites/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Websites/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Websites/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Websites/build-status/master)




## Upgrade notes

### Upgrading from v2
**Database:** There is a new field *route_name.* See `sql/install.sql.txt` on how to create or add the fields.

Classes **PdoAllWebsites** and **PdoRouteWebsiteFactory:** Passing the pages table name to  constructor is now mandatory.

### Upgrading from v1

There are two new database fields **javascripts** and **stylesheets.** See `sql/install.sql.txt` on how to create or add the fields.

According to this, interface *WebsiteInterface* prescribes two methods **getJavascripts** and **getStylesheets**, its implementation class *Website* additionally introduces **setJavascripts** and **setStylesheets**.


## Installation with Composer

```bash
$ composer require germania-kg/websites
```

**MySQL:** When working with database, create your tables using the CREATE TABLE statements in `sql/install.sql.txt`.


## All Websites

The interface **WebsitesInterface** extends *IteratorAggregate, Countable* and the [PSR-11](https://github.com/php-fig/container) *ContainerInterface.*

Class **Websites** implements *WebsitesInterface* and thus can be iterated over and ‘counted’. The **PdoAllWebsites** class is an extension that reads from a MySQL Table.

```php
<?php
use Germania\Websites\PdoAllWebsites;
use Germania\Websites\Website;

// Instantiation
// - optional: Custom Website object template (extension of WebsiteAbstract)
$all_websites = new PdoAllWebsites( $pdo, "my_pages" );
$all_websites = new PdoAllWebsites( $pdo, "my_pages", new Website );


// Countable:
echo count($all_websites);

// Iterator:
foreach( $all_websites as $website):
	echo $website->getTitle(), PHP_EOL;
endforeach;

// ContainerInterface:
// Getting may throw WebsiteNotFoundException
// which implements Psr\Container\NotFoundExceptionInterface
$website_exists = $all_websites->has( 42 );
$website        = $all_websites->get( 42 );
?>
```


## Get a website by route

```php
<?php
use Germania\Websites\PdoRouteWebsiteFactory;
use Germania\Websites\WebsiteNotFoundException;
use Germania\Websites\Website;


// Instantiation
// - optional: Custom Website object template (extension of WebsiteAbstract)
$factory = new PdoRouteWebsiteFactory( $pdo, "my_pages" );
$factory = new PdoRouteWebsiteFactory( $pdo, "my_pages", new Website );
$factory = new PdoRouteWebsiteFactory( $pdo, "my_pages", null );

$route = "/index.html";

// interop ContainerInterface
$exists  = $factory->has( $route );

try { 
	// Callable or ContainerInterface's Getter
	$website = $factory( $route );
	$website = $factory->get( $route );
}
// Interop\Container\Exception\NotFoundException
catch (WebsiteNotFoundException $e) {
	// 404
}
```

## Issues

[Issue 1:][i1] MySQL 5.7.5 has a *ONLY\_FULL\_GROUP\_BY* problem with the SQL query used in class **PdoWebsiteRoutesAcl**.

See [issues list.][i0]

[i0]: https://github.com/GermaniaKG/Websites/issues
[i1]: https://github.com/GermaniaKG/Websites/issues/1

## Development

```bash
$ git clone https://github.com/GermaniaKG/Websites.git
$ cd Websites
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```
