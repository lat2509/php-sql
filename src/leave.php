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
        <title>Leave </title>
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
                <h1 class="titlepage"> Nghỉ phép </h1>

                <hr style="border: 2px solid blue">
                <br>
                <div class="card">
                    <div class="card-body">
                        <table id="leave_table" class="table table-striped table-hover">
                            <thead style="position: sticky; top: 0; ">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Họ và tên </th>
                                    <th scope="col">Lí do</th>
                                    <th scope="col">Chi tiết</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                require_once ('connect.php');

                                $query1 = "select * from nghi_phep_tbl inner join nhan_vien_tbl on nghi_phep_tbl.id_nv=nhan_vien_tbl.id_nv order by ngay_bat_dau";
                                $staff_result = $sql_connect->query($query1);

                                while ($row = $staff_result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id_nghi']; ?></th>
                                        <td><?php echo $row['ten']; ?></td>
                                        <td><?php echo $row['ly_do']; ?></td>
                                        <td><?php echo $row['chi_tiet']; ?></td>
                                        <td><?php echo $row['ngay_bat_dau']; ?></td>
                                        <td><?php echo $row['ngay_ket_thuc']; ?></td>

                                        <td class="leave_status">
                                            <?php
                                            if ($row['trang_thai'] == 0) {
                                                echo "Chưa được duyệt";
                                            } elseif ($row['trang_thai'] == 1) {
                                                echo "Đã duyệt";
                                            } else {
                                                echo "Trạng thái không xác định";
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($row['trang_thai'] == 0) {
                                                ?>
                                                <button class="btn btn-success px-4 confirm_leave"
                                                    data-id="<?php echo $row['id_nghi']; ?>">Duyệt</button>
                                                <?php
                                            } elseif ($row['trang_thai'] == 1) {
                                                ?>
                                                <button class="btn btn-danger px-4 reject_leave"
                                                    data-id="<?php echo $row['id_nghi']; ?>">Hủy</button>
                                                <?php
                                            }
                                            ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                function confirmLeave(e) {
                    e.preventDefault();
                    var leaveId = $(this).data('id');
                    var button = $(this);
                    $.ajax({
                        url: 'confirm_leave.php',
                        type: 'POST',
                        data: {
                            id: leaveId
                        },
                        success: function (response) {
                            button.removeClass('btn-success').addClass('btn-danger').text('Hủy');
                            button.closest('tr').find('.leave_status').text('Đã duyệt');
                            button.off('click').on('click', rejectLeave);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
                function rejectLeave(e) {
                    e.preventDefault();
                    var leaveId = $(this).data('id');
                    var button = $(this);

                    $.ajax({
                        url: 'reject_leave.php',
                        type: 'POST',
                        data: {
                            id: leaveId
                        },
                        success: function (response) {
                            button.removeClass('btn-danger').addClass('btn-success').text('Duyệt');
                            button.closest('tr').find('.leave_status').text('Chưa được duyệt');
                            button.off('click').on('click', confirmLeave);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
                $('.confirm_leave').on('click', confirmLeave);
                $('.reject_leave').on('click', rejectLeave);
            });



        </script>

    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>