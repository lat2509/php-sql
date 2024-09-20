<?php
session_start();
require ('connect.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_employee = $_POST['employee'];
        $income_date = $_POST['income_date'];
        $total_income = $_POST['salary'];

        $insert_query = "INSERT INTO tra_luong_tbl (id, thoi_gian,so_tien,id_nv) 
                         VALUES (NULL, '$income_date', '$total_income','$selected_employee')";
        $sql_connect->query($insert_query);
        header("Location: income.php");
        exit();
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
        <title>Add Income</title>
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
                <h1 class="titlepage">Trả lương cho nhân viên</h1>
                <form method="POST">
                    <div class="mb-3">
                        <hr style="border: 2px solid blue">
                        <br><br>
                        <div class="card card-registration">
                            <div class="card-body">
                                <div class="row">
                                    <label for="employee" class="form-label">Chọn nhân viên:</label>
                                    <select class="form-select" id="employee" name="employee" required>
                                        <option value="" disabled selected>Chọn nhân viên</option>
                                        <?php
                                        $employee_query = "SELECT * FROM nhan_vien_tbl";
                                        $employee_result = $sql_connect->query($employee_query);
                                        if ($employee_result->num_rows > 0) {
                                            while ($row = $employee_result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_nv'] . "'>" . $row['ten'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <label for="income_date" class="form-label">Ngày trả lương:</label>
                                    <input type="date" class="form-control" id="income_date" name="income_date" required>
                                </div>
                                <div class="row mb-3">
                                    <label for="salary" class="form-label">Tiền lương:</label>

                                    <input type="number" class="form-control" id="salary" name="salary"
                                        value="<?php echo $salary; ?>" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Xác nhận</button>

                </form>
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