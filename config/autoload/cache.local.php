<?php

return array(
    'caches' => array(
        'memcached' => array(
            'adapter' => array(
                'name' => 'memcached',
                'options' => array(
                    'servers' => array(
                        array(
                            '127.0.0.1', 11211
                        )
                    ),
                    'ttl' => 604800, // 1 week
                    'namespace' => 'MYMEMCACHEDNAMESPACE',
                    'liboptions' => array(
                        'COMPRESSION' => true,
                        'binary_protocol' => true,
                        'no_block' => true,
                        'connect_timeout' => 100
                    )
                )
            ),
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
            ),
        ),
    ),
);
