<?php
    include("../database/data.php");
    $query = trim($_GET['query']);
    $result = $data->query($query);
    if ($result->num_rows>0){
        echo "false";
    } else echo "true";
    $data->close();
?>