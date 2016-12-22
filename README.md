#Germania\Websites

**This package was destilled from legacy code!**   
You better do not want it to use this in production.

[![Build Status](https://travis-ci.org/GermaniaKG/Websites.svg?branch=master)](https://travis-ci.org/GermaniaKG/Websites)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Websites/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Websites/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Websites/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Websites/?branch=master)

##Upgrade from v1

There are two new database fields **javascripts** and **stylesheets.** See `sql/install.sql.txt` on how to create or add the fields. 

According to this, interface *WebsiteInterface* prescribes two methods **getJavascripts** and **getStylesheets**, its implementation class *Website* additionally introduces **setJavascripts** and **setStylesheets**.


##Installation

```bash
$ composer require germania-kg/websites
```

**MySQL:** When working with database, create your tables using the CREATE TABLE statements in `sql/install.sql.txt`.


##All Websites

The interface **WebsitesInterface** extends *IteratorAggregate, Countable* and the [container-interop](https://github.com/container-interop/container-interop) *ContainerInterface.* (upcoming [PSR 11](https://github.com/php-fig/fig-standards/blob/master/proposed/container.md) standard). 

Class **Websites** implements *WebsitesInterface* and thus can be iterated over and ‘counted’. The **PdoAllWebsites** class is an extension that reads from a MySQL Table. 

```php
<?php
use Germania\Websites\PdoAllWebsites;
use Germania\Websites\Website;

// Instantiation
// - optional: Custom Website object template (extension of WebsiteAbstract)
// - optional: Custom table name
$all_websites = new PdoAllWebsites( $pdo );
$all_websites = new PdoAllWebsites( $pdo, new Website );
$all_websites = new PdoAllWebsites( $pdo, null, "my_pages" );


// Countable:
echo count($all_websites);

// Iterator:
foreach( $all_websites as $website):
	echo $website->getTitle(), PHP_EOL;
endforeach;

// ContainerInterface:
// Getting may throw WebsiteNotFoundException
// Interop\Container\Exception\NotFoundException
$website_exists = $all_websites->has( 42 );
$website        = $all_websites->get( 42 );
?>
```


##Get a website by route

```php
use Germania\Websites\PdoRouteWebsiteFactory;
use Germania\Websites\WebsiteNotFoundException;
use Germania\Websites\Website;


// Instantiation
// - optional: Custom Website object template (extension of WebsiteAbstract)
// - optional: Custom table name
$factory = new PdoRouteWebsiteFactory( $pdo );
$factory = new PdoRouteWebsiteFactory( $pdo, new Website );
$factory = new PdoRouteWebsiteFactory( $pdo, null, "my_pages" );

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



##Development and Testing

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   
**Currently, no tests are specified.**

```bash
$ git clone git@github.com:GermaniaKG/Websites.git germania-websites
$ cd germania-websites
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
