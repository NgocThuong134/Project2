<?php
 include("../database/data.php");
 if ($data->connect_error) {
     die("Kết nối đến cơ sở dữ liệu thất bại: " . $data->connect_error);
 }
 function generateRandomPassword($email) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';

    $length = 8;

    $characterCount = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $characterCount - 1);
        $password .= $characters[$randomIndex];
    }
    $passwordWithMessage = "Đây là mật khẩu mới của bạn: " . $password . ". Vui lòng không chia sẻ cho bất kỳ ai.";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE khachhang SET matkhau = '$hashedPassword' WHERE email = '$email'";
    
    global $data;
    if ($data->query($sql) === TRUE) {
        return $passwordWithMessage;
    } else {
        return "Lỗi khi cập nhật mật khẩu: " . $data->error;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require "../PHPMailer-master/src/PHPMailer.php";
    require "../PHPMailer-master/src/SMTP.php";
    require '../PHPMailer-master/src/Exception.php';
    $guiden = $_POST['emailkhoiphuc'];
    $sql = "SELECT * FROM khachhang WHERE email = '$guiden'";
    $result = $data->query($sql);
    if ($result->num_rows == 0)
    {
        echo "<script>
                setTimeout(function() {
                alert('Email không tồn tại');
                window.location.href = '../index.php';
                }, 2000);
            </script>";
            exit;
    }
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gnouht89@gmail.com';
        $mail->Password = 'rhjj nwer dwnq efqh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('gnouht89@gmail.com', 'Quán ăn đặc sản Miền Tây');
        $mail->addAddress($guiden);
        $mail->isHTML(true);
        $mail->Subject = 'Gửi thư từ Quán ăn đặc sản Miền Tây';
        $mail->Body = nl2br(generateRandomPassword($guiden));
        $mail->smtpConnect(array("ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )));
        $mail->send();
        echo "<script>
                setTimeout(function() {
                alert('Đã gửi mail xong');
                window.location.href = '../index.php';
                }, 2000);
            </script>";
    } catch (Exception $e) {
        echo "<script>
                setTimeout(function() {
                alert('Mail không gửi được. Lỗi: " . $mail->ErrorInfo . "');
                window.location.href = '../index.php';
                }, 2000);
            </script>";
    }
}
?>