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

## License
This package is licensed under GPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!

## Credit
- Facebook: [Piyapan Rodkuen](https://facebook.com/rayspic)
- Twitter: [@raystech_th](https://twitter.com/raystech_th)
- Email: piyapannr\<at\>gmail.com