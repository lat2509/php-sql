<?php

session_start();
$error = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['department_name'])) {
        $error = "Vui lòng không để trống!";
    } else {
        $department_name = $_POST['department_name'];
        $id = $_GET['id'];

        require_once ('connect.php');

        $query = "UPDATE chuc_vu_tbl SET chuc_vu ='$department_name' WHERE id_cv = $id";

        $sql_connect->query($query);

        header("Location: department.php");
        exit();
    }
}


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
        <title>Edit Department</title>
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
                        <ul class="navbar-nav">
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

            <div class="col py-3">
                <h1 class="titlepage">Sửa Chức Vụ</h1>

                <hr style="border: 2px solid blue">
                <br>

                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <label class="form-label">Tên Chức Vụ</label>
                            <input class="form-control form-control-lg" type="text" name="department_name"
                                placeholder="Tên chức vụ">
                            <span class="error">* <?php echo $error ?></span>
                            <br>
                            <input type="submit" name="submit" class="btn btn-lg btn-success float-end"
                                value="Cập nhật"></input>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>

        </ <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>