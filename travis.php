<?php

$configuration = array(
    'language'=> 'php',
    'php'=> array(
        '5.2',
        '5.3',
        '5.4',
        '5.5',
    ),
    'env'=> array(
        'DB=mysql',
        'DB=sqlite'
    ),
    'script'=> 'phpunit --configuration=phpunit_$DB.xml',
);

yaml_emit_file('.travis.yml', $configuration);
