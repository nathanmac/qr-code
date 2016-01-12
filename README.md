QR Code
=======

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nathanmac/qr-code.svg?style=flat-square)](https://packagist.org/packages/nathanmac/qr-code)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/nathanmac/qr-code/master.svg?style=flat-square)](https://travis-ci.org/nathanmac/qr-code)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/nathanmac/qr-code.svg?style=flat-square)](https://scrutinizer-ci.com/g/nathanmac/qr-code/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/nathanmac/qr-code.svg?style=flat-square)](https://scrutinizer-ci.com/g/nathanmac/qr-code)
[![Total Downloads](https://img.shields.io/packagist/dt/nathanmac/qr-code.svg?style=flat-square)](https://packagist.org/packages/nathanmac/qr-code)

Laravel package to providing a simple QR Code generator route

![Hello World Example QR Code](examples/hello-world.png?raw=true)

Installation
------------

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `nathanmac/qr-code`.

	"require": {
		"Nathanmac/qr-code": "1.*"
	}

Next, update Composer from the Terminal:

    composer update

#### Adding the Service Provider

If you are a Laravel user, then there is a service provider that you can make use of to automatically prepare the bindings and such.

Include the service provider within `app/config/app.php`.

```php
'providers' => [
    '...',
    'Nathanmac\Utilities\QRCode\QRCodeServiceProvider'
];
```

Usage
-----

```
/qr-code/{size?}/{color?}/{background?}?text=Text+Contents
```

```
/qrcode/100/ffff00/ff0000/?text=Hello+World
```

![Example 1](examples/example-1.png?raw=true)

```
/qrcode/100/03a/?text=Hello+World
```

![Example 2](examples/example-2.png?raw=true)

Testing
-------

To test the library itself, run the tests:

    composer test

Contributing
------------

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Credits
-------

- [nathanmac](https://github.com/nathanmac)
- [All Contributors](../../contributors)

License
-------

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
