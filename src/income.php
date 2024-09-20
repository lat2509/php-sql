<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {
    require_once ('connect.php');
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

        <title>Income</title>
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
                <h1 class="titlepage"> Danh sách lương </h1>

                <!-- Form to filter salary -->
                <form method="GET">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="timeStart" class="form-label">Từ ngày:</label>
                            <input type="date" class="form-control" id="timeStart" name="time_start">
                        </div>
                        <div class="col">
                            <label for="timeEnd" class="form-label">Đến ngày:</label>
                            <input type="date" class="form-control" id="timeEnd" name="time_end">
                        </div>
                        <div class="col">
                            <label for="employeeSelect" class="form-label">Nhân viên:</label>
                            <select class="form-select" id="employeeSelect" name="employee">
                                <option value="">Chọn nhân viên</option>
                                <?php
                                // Get list of employees
                                $employee_query = "SELECT * FROM nhan_vien_tbl";
                                $employee_result = $sql_connect->query($employee_query);
                                if ($employee_result->num_rows > 0) {
                                    while ($employee_row = $employee_result->fetch_assoc()) {
                                        echo "<option value='" . $employee_row['id_nv'] . "'>" . $employee_row['ten'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col align-self-end">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                        <div class="col align-self-end">
                            <a href="add_income.php" class="btn btn-success">Trả lương</a>
                        </div>
                    </div>
                </form>

                <!-- Table to display filtered salary -->
                <div class="card">
                    <div class="card-body">
                        <table id="salary_table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nhân viên</th>
                                    <th scope="col">Thời gian trả lương</th>
                                    <th scope="col">Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT tra_luong_tbl.id, nhan_vien_tbl.ten, tra_luong_tbl.thoi_gian, tra_luong_tbl.so_tien FROM tra_luong_tbl INNER JOIN nhan_vien_tbl ON tra_luong_tbl.id_nv = nhan_vien_tbl.id_nv";

                                if (isset($_GET['time_start']) && !empty($_GET['time_start']) && isset($_GET['time_end']) && !empty($_GET['time_end'])) {
                                    $query .= " WHERE tra_luong_tbl.thoi_gian BETWEEN '" . $_GET['time_start'] . "' AND '" . $_GET['time_end'] . "'";
                                }
                                if (isset($_GET['employee']) && !empty($_GET['employee'])) {
                                    $query .= " AND tra_luong_tbl.id_nv = '" . $_GET['employee'] . "'";
                                }
                                $sum = 0;
                                $result = $sql_connect->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['ten'] . "</td>
                                        <td>" . $row['thoi_gian'] . "</td>
                                        <td>" . $row['so_tien'] . "</td>
                                        
                                        </tr>";
                                        $sum += $row['so_tien'];
                                    }
                                    echo "<tr>
                                    <td colspan='3'><strong>Tổng tiền lương:</strong></td>
                                    <td><strong>" . $sum . "</strong></td>
                                    </tr>";
                                } else {
                                    echo "<tr>
                                    <td colspan='4'>Không có dữ liệu</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

    <?php
} else {
    header("Location: error.html");
    exit();
}
?>