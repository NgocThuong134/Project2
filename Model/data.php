<?php
    $data = new mysqli("localhost:3307", "root", "", "project2");
    if ($data->connect_error) {
        die('Failed connected: ' . $data->connect_error);
    }
// Kết nối cơ sở dữ liệu
function connectToDatabase() {
    $data = new mysqli("localhost:3307", "root", "", "project2");
    if ($data->connect_error) {
        die('Failed connected: ' . $data->connect_error);
    }

    return $data;
}

// Thực hiện một truy vấn SQL
function executeQuery($query) {
    $data = connectToDatabase();
    $result = $data->query($query);

    if (!$result) {
        echo 'Error executing query: ' . $data->error;
    }

    $data->close();

    return $result;
}

// Thực hiện nhiều truy vấn SQL
function executeMultipleQueries($queries) {
    $data = connectToDatabase();
    $results = [];

    if ($data->multi_query($queries)) {
        do {
            if ($result = $data->store_result()) {
                $results[] = $result;
                $result->free();
            }
        } while ($data->next_result());
    } else {
        echo 'Error executing multiple queries: ' . $data->error;
    }

    $data->close();

    return $results;
}

// Thực hiện câu lệnh INSERT, DELETE hoặc UPDATE
function executeStatement($statement) {
    $data = connectToDatabase();
    $success = $data->query($statement);

    if (!$success) {
        echo 'Error executing statement: ' . $data->error;
    }

    $data->close();

    return $success;
}
?>