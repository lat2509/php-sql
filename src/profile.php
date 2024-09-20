<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" href="https://i.imgur.com/HFRT62v.png">
        <style>
            .profile {
                margin-top: 20px;
                border-radius: 10% !important;
                width: 80%;
                height: auto;
                max-width: 100%;
                max-height: 100%;
            }


            .profile:hover {
                transform: translateX(20px);
                transition: ease-in-out 1s;
                border-radius: 5% !important;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                cursor: pointer;

            }
        </style>
        <title>Profile </title>
    </head>

    <body class="body">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home.php">Hệ thống quản lý nhân viên</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="home.php">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="department.php">Chức Vụ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="staff.php">Nhân Viên</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="salary.php">Lương</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="leave.php">Nghỉ Phép</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="income.php">Phiếu lương</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="profile.php">Thông tin</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8 profile-info" style="text-align: center">
                    <div class="row" style="margin-top: 50px !important;margin-left: 50px">
                        <div class="card card-registration">
                            <br>
                            <h2>Thông tin tài khoản</h2>
                            <hr>
                            <br>
                            <?php
                            require_once ('connect.php');
                            $sql = "SELECT * FROM login_tbl WHERE id_login=1";
                            $result = $sql_connect->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h4>Tài khoản: <?php echo $row['username']; ?></h4>
                            <h4>Loại người dùng: <?php if ($row['user_type'] == 1) {
                                echo "Quản trị viên";
                            } else {
                                echo "Nhân viên";
                            }
                            ?></h4>
                            <br>


                        </div>

                    </div>
                    <div class="row " style="margin-top: 50px !important;margin-left: 50px">
                        <a class="btn btn-success" href="edit_profile.php" role="button">Sửa thông tin</a>
                    </div>
                </div>
                <div class="col-md-4" style="text-align: center; margin-bottom: 50px;">
                    <img src="https://i.imgur.com/qmL3fWb.jpeg" class="profile" alt="Sample image">
                </div>
            </div>



        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: login.php");
    exit();
}
?>