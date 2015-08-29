# Laasti/symfony-session-provider

A league/container service provider for Symfony's session.

## Installation

```
composer require laasti/symfony-session-provider
```

## Usage

```php

$container = new League\Container\Container;
$container->addServiceProvider('Laasti\SymfonySessionProvider\SymfonySessionProvider');

//To add configuration, by default it uses native sessions
$container->add('config.session', []);

//Get session
$session = $container->get('Symfony\Component\HttpFoundation\Session\SessionInterface');

```

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

See CHANGELOG.md for more information.

## Credits

Author: Sonia Marquette (@nebulousGirl)

## License

Released under the MIT License. See LICENSE.txt file.