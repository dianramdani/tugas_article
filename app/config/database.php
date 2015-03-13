<?php
return array(
    'fetch' => PDO::FETCH_CLASS,
    'default' => 'pgsql',
    'connections' => array(
        'pgsql' => array(
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'db_article',
        'username' => 'mdian',
        'password' => 'ramdani',
        'charset' => 'utf8',
        'prefix'=> '',
        'schema'=> 'public',
        ),
    ),
    'migrations' => 'migrations',
);