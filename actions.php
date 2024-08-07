<?php

$config = require_once 'config.php';
require_once 'functions.php';
require_once 'classes/Db.php';
require_once 'classes/Pagination.php';
require_once 'classes/Validator.php';

// Get data from JSON

// Get database connection and 
$db = (Db::getInstance())->getConnection($config['db']);

$data = json_decode(file_get_contents('php://input'), true);

// pagination
if (isset($data['page'])) {
    $page = (int) $data['page'] ?? 1;
    $per_page = $config['per_page'];
    $total = get_count('city');
    $pagination = new Pagination((int) $page, $per_page, $total);
    // start pagination
    $start = $pagination->get_Start();
    // get cities
    $cities = get_cities($start, $per_page);
    require_once 'views/index-content.tpl.php';
    die;
}

// Add city
if (isset($_POST['addCity'])) {
    $data = $_POST;
    // validate
    $validator = new Validator();
    $errors = $validator->validate($data, [
        'name' => [
            'required' => true,
        ],
        'population' => [
            'minNum' => 1,
        ],
    ]);
    if (!($errors->hasErrors())) {
        $db->query("INSERT INTO city (`name`, `population`) VALUES (?, ?)", [$data['name'], 
        $data['population']]);
        $res = ['answer' => 'success'];
        // Send answer to client
    } 
    else {
        $errors_output = '<ul class="list-unstyled text-start text-danger">';
        // get errors
        foreach ($errors->getErrors() as $e) {
            foreach ($e as $error) {
                $errors_output .= "<li>{$error}</li>";
            } 
        }
        $errors_output .= '</ul>' ;
        $res = ['answer' => 'error', 'errors' => $errors_output];
    }
    echo json_encode($res);
    die;
}
