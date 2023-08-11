<?php
session_start();
include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';


if (!isset($_SESSION['admin_id'])) {
    $admin->goTo("login", "invalid_admin");
}
$admin_id = $_SESSION['admin_id'];


if (isset($_POST['create_type'])) {

    $name = mysqli_real_escape_string($db->conn, $_POST['name']);


    $result = $db->setQuery("SELECT * FROM types WHERE name='$name';");
    $numrows = mysqli_num_rows($result);

    if ($numrows == 0) {

        $result = $db->setQuery("INSERT INTO types (name) VALUES ('$name');");
        $admin->goTo("types", "type_created");
    } else {
        $admin->goTo("types", "type_exists");
    }
}



if (isset($_POST['edit_type'])) {

    $name = mysqli_real_escape_string($db->conn, $_POST['name']);
    $current_name = mysqli_real_escape_string($db->conn, $_POST['current_name']);

    $result = $db->setQuery("SELECT * FROM types WHERE name='$name';");
    $numrows = mysqli_num_rows($result);

    if ($numrows == 0 or ($name == $current_name)) {

        $result = $db->setQuery("UPDATE types SET name='$name' WHERE name='$current_name';");
        $admin->goTo("types", "type_edited");
    } else {
        $admin->goTo("types", "edited_type_exists");
    }
}


if (isset($_GET['delete_type'])) {
    $type_name = mysqli_real_escape_string($db->conn, $_GET['type_name']);
    $result = $db->setQuery("DELETE FROM types WHERE name='$type_name';");
    $admin->goTo("types", "type_deleted");
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
                        <h1 class="h3 mb-0 text-gray-800">types</h1>
                        <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_type_modal">Add Type</a>
                    </div>


                    <div class="row">
                        <?php
                        $result = $db->setQuery("SELECT * FROM types;");
                        $numrows = mysqli_num_rows($result);
                        ?>
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">types (<?php echo $numrows; ?>)</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                    if (isset($_GET['type_exists'])) {
                                        echo "<div class='alert alert-danger' style='text-align:center;'>Type already exists!</div>";
                                    }

                                    if (isset($_GET['edited_type_exists'])) {
                                        echo "<div class='alert alert-danger' style='text-align:center;'>The type name you selected is already in use!</div>";
                                    }

                                    if (isset($_GET['type_deleted'])) {
                                        echo "<div class='alert alert-danger' style='text-align:center;'>Type deleted!</div>";
                                    }


                                    if (isset($_GET['type_created'])) {
                                        echo "<div class='alert alert-success' style='text-align:center;'>Type created successfully!</div>";
                                    }

                                    if (isset($_GET['type_edited'])) {
                                        echo "<div class='alert alert-success' style='text-align:center;'>Type edited successfully!</div>";
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                if ($numrows > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>

                                                            <td><?php echo $row['name']; ?></td>
                                                            <td>

                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item edit-type-btn" onclick="editType(this)" type_name="<?php echo $row['name']; ?>" type_image="<?php echo $row['image']; ?>" data-bs-toggle="modal" data-bs-target="#edit_type_modal">Edit</a></li>
                                                                        <li><a class="dropdown-item delete-type-btn" onclick="deleteType(this)" type_name="<?php echo $row['name']; ?>">Delete</a></li>

                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item">Close</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
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





    <!-- Create Type Modal -->
    <div class="modal fade" id="add_type_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">

                        <label>Type Name</label>
                        <input type="text" name="name" class="form-control mb-3" required>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="create_type">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <!--    Edit type Modal -->
    <div class="modal fade" id="edit_type_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" class="edit_type_form">
                    <div class="modal-body">

                        <label>Type Name</label>
                        <input type="text" name="name" class="form-control mb-3 edit-type-name" required>


                        <input type="hidden" name="current_name" class="edit-type-current-name">


                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="edit_type">Submit</button>
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



    <script>
        // $(".edit-type-btn").click(function() {

        //     $(".edit-type-name").val($(this).attr("type_name"));
        //     $(".edit-type-current-name").val($(this).attr("type_name"));
        //     $(".edit-type-current-image").val($(this).attr("type_image"));


        // })

        // $(".delete-type-btn").click(function() {
        //     var type_name = $(this).attr("type_name");
        //     if (confirm("Are you sure you want to delete this type?")) {
        //         window.location.href = `types?delete_type&type_name=${type_name}`;
        //     } else {
        //         return false;
        //     }
        // })

        function editType(type) {
            $(".edit-type-name").val(type.getAttribute("type_name"));
            $(".edit-type-current-name").val(type.getAttribute("type_name"));
        }

        function deleteType(type) {
            var type_name = type.getAttribute("type_name");
            if (confirm("Are you sure you want to delete this type?")) {
                window.location.href = `types?delete_type&type_name=${type_name}`;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>