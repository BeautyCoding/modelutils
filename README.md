# ModelUtils (Laravel 5 Package)

[![Latest Stable Version](https://poser.pugx.org/beautycoding/modelutils/v/stable)](https://packagist.org/packages/beautycoding/modelutils)

[![Total Downloads](https://poser.pugx.org/beautycoding/modelutils/downloads)](https://packagist.org/packages/beautycoding/modelutils)

[![Latest Unstable Version](https://poser.pugx.org/beautycoding/modelutils/v/unstable)](https://packagist.org/packages/beautycoding/modelutils)

[![License](https://poser.pugx.org/beautycoding/modelutils/license)](https://packagist.org/packages/beautycoding/modelutils)

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

Edit config file `config/modelutils.php` with own namespace.

Use in proper model trait `UuidModel`:

```php
<?php

use Illuminate\Database\Eloquent\Model;
use BeautyCoding\ModelUtils\Traits\UuidModel;

class User extends Model
{
    use UuidModel; // add this trait to your model
    ...
}

```

Model has to have field named uuid (32characters long). Check [RFC](http://www.ietf.org/rfc/rfc4122.txt) for more information.