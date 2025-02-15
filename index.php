<?php
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL & ~E_DEPRECATED);
require(__DIR__ . '/src/routes/router.php');