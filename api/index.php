<?php

// Force config cache clear effect
$_ENV['APP_KEY'] = getenv('APP_KEY');
$_ENV['APP_DEBUG'] = getenv('APP_DEBUG');

require __DIR__ . '/../public/index.php';
