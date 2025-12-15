<?php
require_once __DIR__ . '/wp-stubs.php';

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include THEME_DIR . '/front-page.php';
