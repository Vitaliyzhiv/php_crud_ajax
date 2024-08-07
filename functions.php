<?php 

// function that prints arrays

function print_arr($data): void
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
}

// function to create pagination on page

// create function for count notes in database
function get_count(string $table): int
{
    global $db;
    return $db->query("SELECT COUNT(*) FROM {$table}")->findColumn();
}


// function to get cities for displaying on page
function get_cities(int $start, int $per_page): array
{
    global $db;
    return $db->query("SELECT * FROM city LIMIT $start, $per_page")->findAll();
}