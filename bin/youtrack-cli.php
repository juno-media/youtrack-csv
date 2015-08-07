#!/usr/bin/env php
<?php
ini_set('display_errors', true);
$application = require __DIR__.'/../src/bootstrap.php';
$application->run();