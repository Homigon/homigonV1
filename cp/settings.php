<?php
session_start();
include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';


if (!isset($_SESSION['admin_id'])) {
    $admin->goTo("login", "invalid_admin");
}
$admin_id = $_SESSION['admin_id'];


if (isset($_POST['update_details'])) {

    $username = mysqli_real_escape_string($db->conn, $_POST['username']);
    $email = mysqli_real_escape_string($db->conn, $_POST['email']);
    $phone = mysqli_real_escape_string($db->conn, $_POST['phone']);
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);

    $admin->setDetail($admin->admin_id, "username", $username);
    $admin->setDetail($admin->admin_id, "email", $email);
    $admin->setDetail($admin->admin_id, "phone", $phone);
    $admin->setDetail($admin->admin_id, "password", $password);

    $admin->goTo("settings", "details_updated");
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

    <title>Homigon - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/bootstrap5/css/bootstrap5.min.css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Settings</h1>

                    </div>


                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Update Details</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php

                                    if (isset($_GET['details_updated'])) {
                                        echo "<div class='alert alert-success' style='text-align:center;'>Details updated successfully!</div>";
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <label>Username</label>
                                        <input type="text" name="username" value="<?php echo $admin->getDetail($admin->admin_id, "username"); ?>" class="form-control mb-3" required>

                                        <label>Email</label>
                                        <input type="email" name="email" value="<?php echo $admin->getDetail($admin->admin_id, "email"); ?>" class="form-control mb-3" required>

                                        <label>Phone</label>
                                        <input type="tel" name="phone" value="<?php echo $admin->getDetail($admin->admin_id, "phone"); ?>" class="form-control mb-3" required>

                                        <label>Password</label>
                                        <input type="password" name="password" value="<?php echo $admin->getDetail($admin->admin_id, "password"); ?>" class="form-control mb-3" required>

                                        <button class="btn btn-info" name="update_details">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

























                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->





    <!-- Create Category Modal -->
    <div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control mb-3" required>

                        <label>Category Logo (Optional)</label>
                        <input type="file" name="image" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="create_category">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>










    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="assets/vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script> -->

    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script src="../assets/bootstrap5/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap5/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>



</body>

</html>