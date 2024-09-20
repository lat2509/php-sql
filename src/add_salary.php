<?php

session_start();

require_once ('connect.php');

$id_nv = $date = "";
$luong_co_ban = $phu_cap = $tong_luong = 0;
$idErr = $cbErr = $pcErr = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["select_staff"])) {
        $idErr = "Chưa nhập ID nhân viên";
    } else {
        $id_nv = test_input($_POST["select_staff"]);

    }

    if (empty($_POST["date"])) {
        $date = "";
    } else {
        $date = test_input($_POST["date"]);
    }

    if (empty($_POST["luong_co_ban"])) {
        $cbErr = "Chưa nhập lương cơ bản";
    } else {
        $luong_co_ban = test_input($_POST["luong_co_ban"]);
        if (!preg_match("/^[0-9' ]*$/", $luong_co_ban)) {
            $cbErr = "Chỉ bao gồm chữ số";
        }
    }

    if (empty($_POST["phu_cap"])) {
        $pcErr = "Chưa nhập phụ cấp";
    } else {
        $phu_cap = test_input($_POST["phu_cap"]);
        if (!preg_match("/^[0-9' ]*$/", $phu_cap)) {
            $pcErr = "Chỉ bao gồm chữ số";
        }
    }

    $tong_luong = $luong_co_ban + $phu_cap;
}

function checkErr($idErr, $cbErr, $pcErr)
{
    if (!empty($idErr) || !empty($cbErr) || !empty($pcErr)) {
        return false;
    }
    return true;
}

if (isset($_POST['submit'])) {
    if (!empty($id_nv) && !empty($date) && !empty($luong_co_ban) && !empty($phu_cap) && !empty($tong_luong) && checkErr($idErr, $cbErr, $pcErr)) {
        $query = "INSERT INTO luong_tbl(id_luong, id_nv, luong_co_ban, phu_cap, tong_luong, ngay_them, ngay_cap_nhat) 
            VALUES (NULL,'$id_nv','$luong_co_ban','$phu_cap','$tong_luong',NULL,'$date')";

        $sql_connect->query($query);

        header("Location: salary.php");
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
        <link href="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" href="https://i.imgur.com/HFRT62v.png">
        <style>
            .navbar-nav {
                margin-left: auto;
            }
        </style>
        <title>Add Salary</title>
    </head>

    <body class="body">
        <div class="container">
            <!-- Side Bar -->
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

                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="col py-3">
                <h1 class="titlepage">Lương</h1>
                <hr style="border: 2px solid blue">
                <br><br>
                <div class="card card-registration">
                    <div class="card-body">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Thêm bảng lương mới</h3>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label select-label">Chọn nhân viên</label>
                                        <span class="error"> * </span>
                                        <select class="form-select form-control-lg" name="select_staff">
                                            <option value="" disabled selected>Chọn nhân viên</option>
                                            <?php
                                            $query1 = "SELECT * FROM nhan_vien_tbl";
                                            $department_arr = $sql_connect->query($query1);
                                            while ($row = $department_arr->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['id_nv']; ?>"><?php echo $row['ten']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                    <div class="form-outline datepicker w-100">
                                        <label for="birthdayDate" class="form-label">Ngày Cập Nhật</label> <span
                                            class="error"> * </span>
                                        <input type="date" class="form-control form-control-lg" name="date" />

                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4 mb-4 pb-2">

                                    <div class="form-outline">
                                        <label class="form-label" for="emailAddress">Lương Cơ Bản</label> <span
                                            class="error"> * <?php echo $cbErr; ?></span>
                                        <input type="text" name="luong_co_ban" id="luong_co_ban"
                                            class="form-control form-control-lg" oninput="updateSalary(this.value)" />

                                    </div>

                                </div>
                                <div class="col-md-4 mb-4 pb-2">

                                    <div class="form-outline">
                                        <label class="form-label" for="phoneNumber">Phụ Cấp</label> <span class="error"> *
                                            <?php echo $pcErr; ?></span>
                                        <input type="tel" name="phu_cap" id="phu_cap" class="form-control form-control-lg"
                                            oninput="updateSalary(this.value )" />
                                    </div>

                                </div>

                                <div class="col-md-4 mb-4 pb-2">

                                    <div class="form-outline">
                                        <label class="form-label" for="phoneNumber">Tổng Lương</label> <span class="error">
                                            * </span>
                                        <input type="tel" name="tong_luong" class="form-control form-control-lg"
                                            id="tong_luong" />
                                    </div>

                                </div>
                            </div>

                            <div class="mt-4 pt-2">
                                <input class="btn btn-success btn-lg float-end" type="submit" name="submit"
                                    value="Thêm mới" />
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>

        </div>
        </div>
        </div>
        </div>


        <script>
            function updateSalary(val) {
                console.log(val);
                let cb = document.getElementById('luong_co_ban').value === '' ? 0 : document.getElementById('luong_co_ban').value;
                let pc = document.getElementById('phu_cap').value === '' ? 0 : document.getElementById('phu_cap').value;
                document.getElementById('tong_luong').value = parseInt(cb) + parseInt(pc);
            }

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>