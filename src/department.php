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
        <link href="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" href="https://i.imgur.com/HFRT62v.png">
        <title>Department</title>
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
                                <a class="nav-link" href="income.php"> Phiếu lương</a>
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
                <h1 class="titlepage">Chức vụ</h1>

                <hr style="border: 2px solid blue">
                <br>
                <a href="add_department.php" class="btn btn-lg btn-success">Thêm Mới</a>
                <br><br><br>

                <div class="card">
                    <div class="card-body">

                        <table id="department_table" class="table table-striped table-hover">
                            <thead style="position: sticky; top: 0; ">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Chức Vụ</th>
                                    <th scope="col">Ngày Thêm</th>
                                    <th scope="col">Hành Động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                require_once ('connect.php');

                                $query = "select * from chuc_vu_tbl";

                                $result = $sql_connect->query($query);

                                while ($row = $result->fetch_assoc()) {
                                    if ($row['id_cv'] == 0) {
                                        continue;
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id_cv']; ?></th>
                                        <td><?php echo $row['chuc_vu']; ?></td>
                                        <td><?php echo $row['ngay_them']; ?></td>
                                        <td>
                                            <a href="edit_department.php?id=<?php echo $row['id_cv']; ?>"
                                                class="btn btn-success px-4">Sửa</a>
                                            <a onclick="return confirm('Bạn có chắc muốn xoá chức vụ này không?');"
                                                href="delete_department.php?id=<?php echo $row['id_cv']; ?>"
                                                class="btn btn-danger px-4">Xoá</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

        </div>
        </div>
        </div>
        </div>

    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>