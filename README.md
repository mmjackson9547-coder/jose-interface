# PHP JOSE Interface Library

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Spomky-Labs/jose-interface/badges/quality-score.png?s=fe3d53cad6f5f4bb08937b8fd3a130724f870a42)](https://scrutinizer-ci.com/g/Spomky-Labs/jose-interface/)
[![Code Coverage](https://scrutinizer-ci.com/g/Spomky-Labs/jose-interface/badges/coverage.png?s=e7e3e9b9cbcdf8fa798c3b326fea459e1ad90bc0)](https://scrutinizer-ci.com/g/Spomky-Labs/jose-interface/)

[![Build Status](https://travis-ci.org/Spomky-Labs/jose-interface.svg?branch=master)](https://travis-ci.org/Spomky-Labs/jose-interface)
[![HHVM Status](http://hhvm.h4cc.de/badge/spomky-labs/jose-interface.png)](http://hhvm.h4cc.de/package/spomky-labs/jose-interface)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/057ca364-92ed-40a4-a019-73999d167de4/big.png)](https://insight.sensiolabs.com/projects/057ca364-92ed-40a4-a019-73999d167de4)

[![Latest Stable Version](https://poser.pugx.org/spomky-labs/jose-interface/v/stable.png)](https://packagist.org/packages/spomky-labs/jose-interface)
[![Latest Unstable Version](https://poser.pugx.org/spomky-labs/jose-interface/v/unstable.png)](https://packagist.org/packages/spomky-labs/jose-interface)
[![Total Downloads](https://poser.pugx.org/spomky-labs/jose-interface/downloads.png)](https://packagist.org/packages/spomky-labs/jose-interface)
[![License](https://poser.pugx.org/spomky-labs/jose-interface/license.png)](https://packagist.org/packages/spomky-labs/jose-interface)


This library provides interfaces and traits for Jose implementations.

Interfaces are for:

* JW**S** [JSON Web Signature (RFC 7515)](https://tools.ietf.org/html/rfc7515),
* JW**T** [JSON Web Token (RFC 7519)](https://tools.ietf.org/html/rfc7519),
* JW**E** [JSON Web Encryption (RFC 7516)](http://tools.ietf.org/html/rfc7516),
* JW**A** [JSON Web Algorithms (RFC 7518)](http://tools.ietf.org/html/rfc7518).
* JW**K** [JSON Web Key (RFC 7517)](http://tools.ietf.org/html/rfc7517).

## The Release Process ##

We manage the releases of the library through features and time-based models.

- A new patch version comes out every month when you made backwards-compatible bug fixes.
- A new minor version comes every six months when we added functionality in a backwards-compatible manner.
- A new major version comes every year when we make incompatible API changes.

The meaning of "patch" "minor" and "major" comes from the Semantic [Versioning strategy](http://semver.org/).

This release process applies for all versions.

### Backwards Compatibility

We allow developers to upgrade with confidence from one minor version to the next one.

Whenever keeping backward compatibility is not possible, the feature, the enhancement or the bug fix will be scheduled for the next major version.

## Prerequisites ##

This library needs at least `PHP 5.4`

## Installation ##

The preferred way to install this library is to rely on Composer:

```sh
composer require spomky-labs/jose-interface "~2.3"
```

## Licence

This software is release under [MIT licence](LICENSE).
