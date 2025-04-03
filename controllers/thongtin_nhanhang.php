<?php
$fullname = isset($_GET['fullname']) ? $_GET['fullname'] : null;
$phone = isset($_GET['phone']) ? $_GET['phone'] : null;
$address = isset($_GET['address']) ? $_GET['address'] : null;
$email = isset($_GET['email']) ? $_GET['email'] : null;
$note = isset($_GET['note']) ? $_GET['note'] : null;
session_start();
// Lưu các giá trị vào session
$_SESSION['fullname'] = $fullname;
$_SESSION['phone'] = $phone;
$_SESSION['address'] = $address;
$_SESSION['email'] = $email;
$_SESSION['note'] = $note;
?>