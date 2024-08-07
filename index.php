<?php 

$config = require_once 'config.php';
require_once 'functions.php';
require_once 'classes/Db.php';
require_once 'classes/Pagination.php';
require_once 'classes/Validator.php';

// Get database connection and 
$db = (Db::getInstance())->getConnection($config['db']);
// Get page number 
$page = $_GET['page'] ?? 1;
// Get records per page
$per_page = $config['per_page'];
// Get total number of cities
$total = get_count('city');
// create pagination 
$pagination = new Pagination((int)$page, $per_page, $total);
// start pagination
$start = $pagination->get_Start();
// get cities
$cities = get_cities($start, $per_page);

require_once 'views/index.tpl.php';  