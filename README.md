# ModelUtils (Laravel 5 Package)

In order to install Laravel 5 ModelUtils, just add

    "beautycoding/modelutils": "dev-master"

to your composer.json. Then run `composer install` or `composer update`.

Then in your `config/app.php` add
```php
    BeautyCoding\ModelUtils\ModelUtilsServiceProvider::class,
```

Publish config:

```php
    php artisan vendor:publish
```

Edit config file `config/modelutils.php` with own namespace,
and in proper model use trait:

```php
    use BeautyCoding\ModelUtils\Traits\UuidModel;
```

Remember - model has to have field named uuid (32characters long) - http://www.ietf.org/rfc/rfc4122.txt