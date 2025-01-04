<?php

/*require_once 'src/blog.php';
require_once 'src/helpers.php';
require_once 'src/main.php';
require_once 'src/fread.php';
require_once 'src/fwrite.php';*/

require __DIR__ . '/vendor/autoload.php';

$result = main();

echo $result;