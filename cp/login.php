<?php
session_start();
include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db->conn, $_POST['username']);
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);

    $result = $db->setQuery("SELECT * FROM admin WHERE username='$username';");
    $numrows = mysqli_num_rows($result);

    if ($numrows != 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $password) {
            $_SESSION['admin_id'] = $row['id'];
            $admin->goTo("./", "login_success");
        } else {
            $admin->goTo("login", "invalid_password");
        }
    } else {
        $admin->goTo("login", "invalid_username");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Foods Naija - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../assets/bootstrap5/css/bootstrap5.min.css">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/vendors.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="max-width:500px;margin:auto;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <?php
                                        if (isset($_GET['invalid_username'])) {
                                            echo "<div class='alert alert-danger' style='text-align:center;'>Username does not exists!</div>";
                                        }

                                        if (isset($_GET['invalid_password'])) {
                                            echo "<div class='alert alert-danger' style='text-align:center;'>Password is incorrect!</div>";
                                        }

                                        ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="" aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="" placeholder="Password">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" name="submit">
                                            Login
                                        </button>


                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="../assets/bootstrap5/js/bootstrap.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>