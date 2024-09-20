<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="https://i.imgur.com/HFRT62v.png">
    <title>Login Page</title>
</head>

<body class="body">
    <div class="login_form mt-5 mx-auto ">
        <section class="vh-100">
            <div class="container h-custom ">
                <div class="row">
                    <p class="h1 text-center">Hệ thống quản lý nhân viên - PTIT IT SOLUTIONS</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="row">
                    <div class="center row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="https://i.imgur.com/SYp0zVh.png" class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <p class="h1">Đăng nhập</p>

                            <?php
                            if (isset($_GET['error'])) { ?>
                                <p class="error"> <?php echo $_GET['error']; ?></p>
                                <?php
                            } ?>
                            <form method="post">
                                <!-- Username input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Tài khoản</label>
                                    <input type="text" name="username" id="form3Example3"
                                        class="form-control form-control-lg" />
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="form3Example4">Mật khẩu</label>
                                    <input type="password" name="password" id="form3Example4"
                                        class="form-control form-control-lg" />
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="forget_password.php" class="text-body">Quên mật khẩu?</a>
                                </div>

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    </div>


    <?php

    function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if (isset($_POST['submit'])) {

        require_once ('connect.php');

        session_start();
        $username = validation($_POST["username"]);
        $password = validation($_POST["password"]);

        if (empty($username)) {
            header("Location: login.php?error=Chưa nhập tài khoản");
            exit();
        }

        if (empty($password)) {
            header("Location: login.php?error=Chưa nhập mật khẩu");
            exit();
        }

        $query = "SELECT * FROM login_tbl WHERE username='$username' AND password='$password'";

        $result = $sql_connect->query($query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $username && $row['password'] == $password) {
                if ($row['user_type'] == 1) {
                    echo "Logged In";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['logged_in'] = true;
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Bạn không có quyền truy cập vào phần này";
                }

            }
        } else {
            header("Location: login.php?error=Tài khoản hoặc mật khẩu chưa đúng");
            exit();
        }
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>