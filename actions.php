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

// Get city
if (isset($data['action']) && $data['action'] == 'get_city') {
    $id = isset($data['id']) ? (int)($data['id']) : 0;
    $city = $db->query("SELECT * FROM city WHERE  id = ?", [$id])->find();
    // if we get city
    if ($city) {
        $res = ['answer' => 'success', 'city' => $city];
    } 
    else {
        $res = ['answer' => 'error'];
    }
    echo json_encode($res);
    die;
}

// Edit city
if (isset($_POST['editCity'])) {
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
        'id' => [
            'minNum' => 1,
        ],
    ]);
    if (!($errors->hasErrors())) {
        $db->query("UPDATE city SET `name` = ?, `population` = ? WHERE id = ?", [$data['name'], 
        $data['population'], $data['id']]);
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

// Delete city 
if (isset($data['action']) && $data['action'] == 'delete_city') {
    $id = isset($data['id']) ? (int)($data['id']) : 0;
    $res = $db->query("DELETE FROM city WHERE  id = ?", [$id]);
    // if we get city
    if ($res) {
        $res = ['answer' => 'success'];
    } 
    else {
        $res = ['answer' => 'error'];
    }
    echo json_encode($res);
    die;
}

  
