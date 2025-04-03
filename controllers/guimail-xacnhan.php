<?php
session_start();
 function generateRandomPassword() {
    $characters = '0123456789';
    $password = '';

    $length = 6;

    $characterCount = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $characterCount - 1);
        $password .= $characters[$randomIndex];
    }
    return $password;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require "../PHPMailer-master/src/PHPMailer.php";
    require "../PHPMailer-master/src/SMTP.php";
    require '../PHPMailer-master/src/Exception.php';
    $guiden = $_SESSION['email'];
    $maXN = generateRandomPassword();
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
        $mail->Body = '
        <p style="font-size:15px;">
            Đây là mã xác nhận đơn hàng của bạn: <strong style="font-size: 20px;">' . nl2br($maXN) . '</strong>.
            <br>Có hiệu lực trong vòng <span style="font-size:20px; color: red; ">60 giây</span>.
            <br>Vui lòng không chia sẻ cho bất kỳ ai.
        </p>';
        $mail->smtpConnect(array("ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )));
        $mail->send();
        $response = array('maXN' => $maXN);
        echo json_encode($response);
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