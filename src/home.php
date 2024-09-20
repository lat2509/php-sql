<?php
session_start();
require ('connect.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {

    // Kiểm tra xem người dùng đã gửi yêu cầu POST chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $query = "SELECT id_nv, SUM(DATEDIFF(ngay_ket_thuc, ngay_bat_dau) + 1) AS total_leave_days
                  FROM nghi_phep_tbl
                  WHERE MONTH(ngay_bat_dau) = $month AND YEAR(ngay_bat_dau) = $year
                  GROUP BY id_nv
                  ORDER BY total_leave_days DESC
                  LIMIT 3";

        $result = $sql_connect->query($query);

        if ($result->num_rows > 0) {
            $top_leave_employees = array();
            while ($row = $result->fetch_assoc()) {
                $top_leave_employees[] = $row;
            }
        } else {
            $top_leave_employees = array();
        }
    }
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
        <title>Home Page</title>
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

            <div class="col py-3">
                <div class="row ">
                    <h1 class="titlepage">Trang chủ</h1>
                    <br><br>
                </div>
                <hr style="border: 2px solid blue">
                <div class="row mt-5 ml-5" style="justify-content: center">
                    <div class=" col-4 pd-3" style="background-color: #6DC5D1">
                        <?php
                        $query = "SELECT COUNT(id_nv) AS total_employees FROM nhan_vien_tbl";
                        $result = $sql_connect->query($query);
                        $row = $result->fetch_assoc();
                        $total_employees = $row['total_employees'];
                        ?>
                        <h4> Số lượng nhân viên : <?php echo $total_employees ?></h4>
                    </div>
                    <div class=" col-4 pd-3 " style="background-color: #FEB941">
                        <?php
                        $query = "SELECT SUM(so_tien) AS total_salary FROM tra_luong_tbl";
                        $result = $sql_connect->query($query);
                        $row = $result->fetch_assoc();
                        $total_salary = $row['total_salary'];
                        ?>
                        <h4> Tổng số tiền lương : <?php echo $total_salary ?> vnđ</h4>
                    </div>
                </div>
                <div class="row mt-5 ml-5 ">
                    <div class=" col-4 pd-3" style="background-color: #007F73">
                        <div class="">
                            <form method="POST">
                                <div class="row mb-3">
                                    <h5 class="text-center mt-3"><strong> Top 3 nhân viên nghỉ nhiều nhất</strong></h5>
                                </div>
                                <form method="POST">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <select class="form-select" id="month" name="month" required>
                                                <option value="" disabled selected>Chọn tháng</option>
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" id="year" name="year" required>
                                                <option value="" disabled selected>Chọn năm</option>
                                                <?php
                                                $current_year = date("Y");
                                                for ($i = $current_year; $i >= $current_year - 10; $i--) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary"
                                                style="background-color: green">Xác nhận</button>
                                        </div>
                                    </div>
                                </form>


                                <?php
                                if (!empty($top_leave_employees)) {

                                    echo "<table class='table table-bordered table-transparent'>";
                                    echo "<thead><tr><th>ID Nhân viên</th><th> Họ và tên </th><th>Số ngày nghỉ</th></tr></thead>";
                                    echo "<tbody>";
                                    foreach ($top_leave_employees as $employee) {
                                        $query = "SELECT ten FROM nhan_vien_tbl WHERE id_nv = " . $employee['id_nv'];
                                        $result = $sql_connect->query($query);
                                        $row = $result->fetch_assoc();
                                        $employee['ten'] = $row['ten'];
                                        echo "<tr><td>" . $employee['id_nv'] . "</td>  <td> " . $employee['ten'] . "</td><td>" . $employee['total_leave_days'] . "</td></tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<p>Không có dữ liệu.</p>";
                                }
                                ?>
                        </div>
                    </div>
                    <div class="col-4 pd-3" style="background-color: #7AB2B2">
                        <div class="row">
                            <h5 class="text-center mt-3"><strong> Top 5 nhân viên lương cao nhất</strong></h5>
                        </div>
                        <div class="row ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Họ và tên</th>
                                        <th>Chức vụ</th>
                                        <th>Lương</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from luong_tbl inner join nhan_vien_tbl on luong_tbl.id_nv=nhan_vien_tbl.id_nv join chuc_vu_tbl on nhan_vien_tbl.id_chuc_vu=chuc_vu_tbl.id_cv order by tong_luong desc limit 5";
                                    $result = $sql_connect->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row['ten'] . "</td>  <td> " . $row['chuc_vu'] . "</td><td>" . $row['tong_luong'] . "</td></tr>";
                                        }
                                    } else {
                                        echo "<p>Không có dữ liệu.</p>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4 pd-3" style="background-color: #007F73">
                        <div class="row">
                            <h5 class="text-center mt-3"><strong> Top 5 vị trí nhiều nhân viên nhất</strong></h5>
                        </div>
                        <div class="row ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Chức vụ</th>
                                        <th>Số lượng nhân viên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select count(id_nv) as soluong, chuc_vu_tbl.chuc_vu from nhan_vien_tbl join chuc_vu_tbl on nhan_vien_tbl.id_chuc_vu=chuc_vu_tbl.id_cv group by chuc_vu_tbl.chuc_vu order by soluong desc limit 5";
                                    $result = $sql_connect->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row['chuc_vu'] . "</td>  <td> " . $row['soluong'] . "</td></tr>";
                                        }
                                    } else {
                                        echo "<p>Không có dữ liệu.</p>";
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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