#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$config = require __DIR__.'/App/Config/main.php';

$app = new \App\Console\ConsoleApplication('console', '1.0', $config);
$app->run();
