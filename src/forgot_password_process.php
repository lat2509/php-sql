<?php
$email = $_POST["email"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem đã gửi email thành công hay chưa (đây là một phần giả định)
    $emailSent = true; // Giả sử email đã được gửi thành công

} else {
    // Trường hợp không phải là phương thức POST, chẳng hạn như truy cập trang này trực tiếp từ trình duyệt
    echo "<p>Trang này chỉ được truy cập thông qua việc gửi yêu cầu từ form.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật kh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="https://i.imgur.com/HFRT62v.png">
</head>

<body class="body">
    <div class="container" style="align-items: center;justify-content: center;margin-top: 200px;">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header text-center">
                        <h3>Đã gửi email</h3>
                    </div>

                    <div class="card-body text-center">
                        <h3 class="text-center text-success"> Email đã được gửi đến <?php echo $email; ?> </h3>
                        <img src="https://i.imghippo.com/files/oICae1715282906.webp" alt="" border="0"
                            style="width: 80%;">
                    </div>
                    <div class="card-footer text-center">
                        <a href="login.php" class="btn btn-primary">Quay lại trang đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>