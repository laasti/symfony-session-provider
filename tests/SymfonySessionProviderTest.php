<?php

namespace Laasti\SymfonySessionProvider\Tests;

use Laasti\SymfonySessionProvider\SymfonySessionProvider;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class SymfonySessionProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        $container = new Container();
        $container->addServiceProvider(new SymfonySessionProvider);

        $this->assertTrue($container->get('Symfony\Component\HttpFoundation\Session\SessionInterface') instanceof Session);
    }

    public function testProvider()
    {
        $container = new Container();
        $container->add('config.session', [
            'storage_class' => 'Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage',
            'storage_args' => ['SESSMOCK_LAASTI']
        ]);
        $container->addServiceProvider(new SymfonySessionProvider);

        $session = $container->get('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($session,
                'storage') instanceof MockArraySessionStorage);
    }
}
