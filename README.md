#Germania\Websites

**This package was destilled from legacy code!**   
You better do not want it to use this in production.


##Installation

```bash
$ composer require germania-kg/websites
```

**MySQL:** When working with database, create your table using the CREATE TABLE in `sql/germania-websites.sql`.


##Usage

The interface **WebsitesInterface** extends *IteratorAggregate, Countable* and the [container-interop](https://github.com/container-interop/container-interop) *ContainerInterface.* (upcoming [PSR 11](https://github.com/php-fig/fig-standards/blob/master/proposed/container.md) standard). 

Class **Websites** implements *WebsitesInterface* and thus can be iterated over and ‘counted’. The **PdoAllWebsites** class is an extension that reads from a MySQL Table. 

```php
<?php
use Germania\Websites\PdoAllWebsites;

// Instantiation
// - optional: Custom Website object template (extension of WebsiteAbstract)
// - optional: Custom table name
$all_websites = new PdoAllWebsites( $pdo );
$all_websites = new PdoAllWebsites( $pdo, new MyWebsite );
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


##Development and Testing

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow).   
**Currently, no tests are specified.**

```bash
$ git clone git@github.com:GermaniaKG/Websites.git germania-websites
$ cd germania-websites
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
