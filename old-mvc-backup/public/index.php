<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

// Autoloader
require_once '../vendor/autoload.php';

// Load Config
require_once '../config/config.php';

// Load Database
require_once '../config/database.php';

// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';
