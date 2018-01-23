## PSU Passport Authentication for Laravel 5
Hey! This package is still a Work in Progress. Files, instructions, and other stuff might change!
## Installation
Require this package in your composer.json and update composer. This will download the package and PSU Passport.

```php
composer require raystech/psu-passport
```
Add the ServiceProvider to the providers array in config/app.php

```php
Raystech\PSUPassport\PSUPassportServiceProvider::class,
```
You can use the facade for shorter code; if using Laravel 5.4 or lower, add this to your aliases:

```php
'PSUPassport' => Raystech\PSUPassport\Facades\Passport::class,
```


## License
This package is licensed under MIT. You can do whatever you want as long as you include the original copyright and license notice in any copy of the software/source. 

## Credit
- Facebook: [Piyapan Rodkuen](https://facebook.com/rayspic)
- Twitter: [@raystech_th](https://twitter.com/raystech_th)
- Email: piyapannr\<at\>gmail.com