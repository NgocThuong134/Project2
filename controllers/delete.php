<?php
    include("../database/data.php");
    $query = $_GET['sql'];
    $result = $data->query($query);
    if ($result){
        echo "true";
    } else echo "false!";
    $data->close();
?>