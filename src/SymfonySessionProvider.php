<?php

namespace Laasti\SymfonySessionProvider;

class SymfonySessionProvider extends \League\Container\ServiceProvider
{

    protected $provides = [
        'Symfony\Component\HttpFoundation\Session\SessionInterface',
        'Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface',
        'Symfony\Component\HttpFoundation\Session\Storage\MetadataBag',
    ];
    protected $defaultConfig = [
        'session_class' => 'Symfony\Component\HttpFoundation\Session\Session',
        'storage_class' => 'Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage',
        'storage_args' => [
            [
                'cache_limiter' => 'nocache',
                'cookie_domain' => '',
                'cookie_httponly' => '',
                'cookie_lifetime' => '0',
                'cookie_path' => '/',
                'cookie_secure' => '',
                'entropy_file' => '',
                'entropy_length' => '0',
                'gc_divisor' => '100',
                'gc_maxlifetime' => '1440',
                'gc_probability' => '1',
                'hash_bits_per_character' => '4',
                'hash_function' => '0',
                'name' => 'LAASTI_PHPSESSID',
                'referer_check' => '',
                'serialize_handler' => 'php',
                'use_cookies' => '1',
                'use_only_cookies' => '1',
                'use_trans_sid' => '0',
                'upload_progress.enabled' => '1',
                'upload_progress.cleanup' => '1',
                'upload_progress.prefix' => 'upload_progress_',
                'upload_progress.name' => 'PHP_SESSION_UPLOAD_PROGRESS',
                'upload_progress.freq' => '1%',
                'upload_progress.min-freq' => '1',
                'url_rewriter.tags' => 'a=href,area=href,frame=src,form=,fieldset=',
            ]
        ],
        'metadata_key' => '_laasti_meta',
    ];

    public function register()
    {
        $di = $this->getContainer();

        $config = $this->defaultConfig;
        if (isset($di['config.session']) && is_array($di['config.session'])) {
            $config = array_merge($config, $di['config.session']);
        }
        $di->add('Symfony\Component\HttpFoundation\Session\Storage\MetadataBag')->withArgument($config['metadata_key']);

        $di->add('Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface',
            $config['storage_class'])->withArguments([
            $config,
            null,
            'Symfony\Component\HttpFoundation\Session\Storage\MetadataBag'
        ]);


        $di->add('Symfony\Component\HttpFoundation\Session\SessionInterface', $config['session_class'],
            true)->withArgument('Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface');
    }
}
