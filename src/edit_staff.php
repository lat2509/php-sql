<?php

session_start();
require_once ('connect.php');

$nameErr = $emailErr = $genderErr = $addressErr = $phoneErr = "";
$name = $email = $gender = $birth = $address = $phone = $department = $join = $avatar = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$id = $_GET['id'];

$query_staff_by_ID = "SELECT * FROM nhan_vien_tbl WHERE id_nv=$id";

$staff_result = $sql_connect->query($query_staff_by_ID);

if (mysqli_num_rows($staff_result) == 1) {
    $staff = mysqli_fetch_assoc($staff_result);
    $name = $staff['ten'];
    $birth = $staff['ngay_sinh'];
    $gender = $staff['gioi_tinh'];
    $phone = $staff['so_dien_thoai'];
    $email = $staff['email'];
    $address = $staff['dia_chi'];
    $department = $staff['id_chuc_vu'];
    $join = $staff['ngay_vao_lam'];
    $avatar = $staff['anh'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Chưa nhập tên";
    } else {
        $name = test_input($_POST["name"]);

    }

    if (empty($_POST["email"])) {
        $emailErr = "Chưa nhập emal";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Sai định dạng email";
        }
    }

    if (empty($_POST["address"])) {
        $address = "";
        $addressErr = "Chưa nhập địa chỉ";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["birth"])) {
        $birth = "";
    } else {
        $birth = test_input($_POST["birth"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Chưa chọn giới tính";
    } else {
        $gender = $_POST["gender"];
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Chưa nhập số điện thoại";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9' ]*$/", $phone)) {
            $phoneErr = "Chỉ bao gồm chữ số";
        }
    }

    if (empty($_POST["select_department"])) {
        $department = "";
    } else {
        $department = test_input($_POST["select_department"]);
    }

    if (empty($_POST["join"])) {
        $join = "";
    } else {
        $join = test_input($_POST["join"]);
    }

    if (empty($_POST["avatar"])) {
        $avatar = "https://cdn-icons-png.flaticon.com/512/3541/3541871.png";
    } else {
        $avatar = test_input($_POST["avatar"]);
    }
}

function checkErr($nameErr, $emailErr, $genderErr, $addressErr, $phoneErr)
{
    if (!empty($nameErr) || !empty($emailErr) || !empty($genderErr) || !empty($addressErr) || !empty($phoneErr)) {
        return false;
    }
    return true;
}

if (isset($_POST['submit'])) {

    if (!empty($name) && !empty($email) && !empty($avatar) && !empty($birth) && !empty($gender) && !empty($address) && !empty($phone) && !empty($department) && !empty($join) && checkErr($nameErr, $emailErr, $genderErr, $addressErr, $phoneErr)) {
        $query = "UPDATE nhan_vien_tbl
            SET ten='$name',ngay_sinh='$birth',gioi_tinh='$gender',so_dien_thoai='$phone',email='$email',dia_chi='$address',id_chuc_vu='$department',ngay_vao_lam='$join',anh='$avatar',ngay_cap_nhat='$join' 
            WHERE id_nv=$id";

        $sql_connect->query($query);

        header("Location: staff.php");
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

        <title>Edit Staff</title>
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
                <h1 class="titlepage">Nhân Viên</h1>
                <hr style="border: 2px solid blue">
                <br><br>

                <div class="card card-registration">

                    <div class="card-body">

                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Cập nhật thông tin nhân viên</h3>
                        <form method="post">

                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <label class="form-label" for="firstName">Họ và tên</label> <span class="error"> *
                                            <?php echo $nameErr; ?></span>
                                        <input type="text" name="name" class="form-control form-control-lg"
                                            value="<?php echo $name ?>" />
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <label class="form-label" for="lastName">Email</label> <span class="error"> *
                                            <?php echo $emailErr; ?></span>
                                        <input type="text" name="email" class="form-control form-control-lg"
                                            value="<?php echo $email ?>" />
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">

                                    <div class="form-outline datepicker w-100">
                                        <label for="birthdayDate" class="form-label">Ngày sinh</label> <span class="error">
                                            * </span>
                                        <input type="date" class="form-control form-control-lg" name="birth"
                                            value="<?php echo $birth ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">

                                    <p class="mb-2 pb-1">Giới tính: </p> <span class="error"> * </span>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                            value="Nam" checked />
                                        <label class="form-check-label" for="maleGender">Nam</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                            value="Nữ" />
                                        <label class="form-check-label" for="femaleGender">Nữ</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="otherGender"
                                            value="Khác" />
                                        <label class="form-check-label" for="otherGender">Khác</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <label class="form-label" for="emailAddress">Địa chỉ</label> <span class="error"> *
                                            <?php echo $addressErr; ?></span>
                                        <input type="text" name="address" class="form-control form-control-lg"
                                            value="<?php echo $address ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <label class="form-label" for="phoneNumber">Số điện thoại</label> <span
                                            class="error"> * <?php echo $phoneErr; ?></span>
                                        <input type="tel" name="phone" class="form-control form-control-lg"
                                            value="<?php echo $phone ?>" />
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4 pb-2">
                                    <label class="form-label select-label">Chức vụ</label> <span class="error"> * </span>
                                    <select class="form-select form-control-lg" name="select_department">
                                        <?php
                                        $query1 = "SELECT * FROM chuc_vu_tbl where id_cv=$department LIMIT 1";
                                        $department_arr = $sql_connect->query($query1);

                                        $chuc_vu = $department_arr->fetch_assoc();

                                        ?>
                                        <option value="<?php echo $department ?>"><?php echo $chuc_vu['chuc_vu'] ?></option>
                                        <?php
                                        $query1 = "SELECT * FROM chuc_vu_tbl";
                                        $department_arr = $sql_connect->query($query1);

                                        while ($row = $department_arr->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['id_cv']; ?>"><?php echo $row['chuc_vu']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="col-md-4 mb-4 pb-2">
                                    <label for="birthdayDate" class="form-label">Ngày vào làm</label> <span class="error"> *
                                    </span>
                                    <input type="date" class="form-control form-control-lg" name='join'
                                        value="<?php echo $join ?>" />

                                </div>
                                <div class="col-md-4 mb-4 pb-2">
                                    <label class="form-label" for="customFile">Link Avatar</label>
                                    <input type="text" class="form-control" name="avatar" value="<?php echo $avatar ?>" />

                                </div>
                            </div>

                            <div class="mt-4 pt-2">
                                <input class="btn btn-success btn-lg float-end" type="submit" name="submit"
                                    value="Cập nhật" />
                                <header>
                            </div>

                        </form>
                    </div>
                </div>

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
    header("Location: error.html");
    exit();
}
?>