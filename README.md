# Laravel Force HTTPS Package
A small Composer package for Laravel 5.0 and above to force HTTPS in the URL via middleware.

## Table of Contents

* [Installation](#installation)
    * [Composer, Environment, and Service Provider](#composer-environment-and-service-provider)
        * [Composer](#composer)
        * [Environment](#environment)
        * [Service Provider](#service-provider)
    * [Middleware Installation](#middleware-installation)
    * [Publish Everything](#publish-everything)
* [Required Environment Variables](#required-environment-variables)
* [Middleware](#middleware)
    * [Force HTTPS Middleware](#force-https-middleware)
* [Resources](#resources)

## Installation

### Composer, Environment, and Service Provider

#### Composer

To install from Composer, use the following command:

```
composer require csun-metalab/laravel-force-https
```

#### Environment

Now, add the following line(s) to your `.env` file:

```
FORCE_HTTPS=true
```

This will enable the forcing functionality.

#### Service Provider

Add the service provider to your `providers` array in `config/app.php` in Laravel as follows:

```
'providers' => [
   //...

   CSUNMetaLab\ForceHttps\Providers\ForceHttpsServiceProvider::class,

   // You can also use this based on Laravel convention:
   // 'CSUNMetaLab\ForceHttps\Providers\ForceHttpsServiceProvider',

   //...
],
```

### Middleware Installation

Add the middleware to your `$middleware` array in `app/Http/Kernel.php` to apply it to all requests the application receives:

```
protected $middleware = [
	//...

	CSUNMetaLab\ForceHttps\Http\Middleware\ForceHttps::class,

	// You can also use this based on Laravel convention:
	// 'CSUNMetaLab\ForceHttps\Http\Middleware\ForceHttps',

	//...
];
```

### Publish Everything

Finally, run the following Artisan command to publish everything:

```
php artisan vendor:publish
```

The following assets are published:

* Configuration (tagged as `config`) - these go into your `config` directory

## Required Environment Variables

You added an environment variable to your `.env` file that controls the protocol the application traffic uses.

### FORCE_HTTPS

Whether to force HTTPS on all URLs or not. Default is `false` to prevent any unexpected issues from forcing HTTPS directly upon installation.

## Middleware

### Force HTTPS Middleware

This class is namespaced as `CSUNMetaLab\ForceHttps\Http\Middleware\ForceHttps`.

The middleware performs the following steps:

1. Checks to see if the application configuration requests traffic to be forced over HTTPS
2. If so, it performs the following steps:
    1. Resolves the request URI as an absolute URL so it can also see the protocol
    2. If the protocol is `http:` then it replaces it with `https:` and returns a redirect
3. If not, it passes the request instance to the next configured middleware in the pipeline

## Resources

### Middleware

* [Middleware in Laravel 5.0](https://laravel.com/docs/5.0/middleware)
* [Middleware in Laravel 5.1](https://laravel.com/docs/5.1/middleware)
* [Middleware in Laravel 5.2](https://laravel.com/docs/5.2/middleware)
* [Middleware in Laravel 5.3](https://laravel.com/docs/5.3/middleware)
* [Middleware in Laravel 5.4](https://laravel.com/docs/5.4/middleware)
* [Middleware in Laravel 5.5](https://laravel.com/docs/5.5/middleware)