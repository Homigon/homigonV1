<?php
session_start();
include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';
include '../classes/items.class.php';


if (!isset($_SESSION['admin_id'])) {
    $admin->goTo("login", "invalid_admin");
}
$admin_id = $_SESSION['admin_id'];


if (isset($_POST['update_status'])) {
    $status = mysqli_real_escape_string($db->conn, $_POST['status']);
    $item_id = mysqli_real_escape_string($db->conn, $_POST['item_id']);

    $item->setDetail($item_id, "status", $status);

    $admin->goTo("items", "status_updated");
}



if (isset($_GET['delete_item'])) {

    $item_id = mysqli_real_escape_string($db->conn, $_GET['item_id']);
    $result = $db->setQuery("DELETE FROM items WHERE item_id='$item_id';");
    $db->setQuery("DELETE FROM saved_items WHERE item_id='$item_id';");
    $admin->goTo("items", "item_deleted");
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>



                    <div class="row">
                        <?php
                        $result = $db->setQuery("SELECT * FROM items;");
                        $numrows = mysqli_num_rows($result);
                        ?>
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Items (<?php echo $numrows; ?>)</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                    if (isset($_GET['balance_updated'])) {
                                        echo "<div class='alert alert-success' style='text-align:center;'>Balance updated!</div>";
                                    }

                                    if (isset($_GET['status_updated'])) {
                                        echo "<div class='alert alert-success' style='text-align:center;'>Status updated!</div>";
                                    }

                                    if (isset($_GET['item_deleted'])) {
                                        echo "<div class='alert alert-danger' style='text-align:center;'>Item deleted!</div>";
                                    }
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                    <th>Item Type</th>
                                                    <th>Title</th>
                                                    <th>Location</th>
                                                    <th>Condition</th>
                                                    <th>Nearest Bustop</th>
                                                    <th>Bedrooms</th>
                                                    <th>Amenities</th>
                                                    <th>Toilets</th>
                                                    <th>Price</th>
                                                    <th>Bathrooms</th>
                                                    <th>Additional Information</th>
                                                    <th>Status</th>
                                                    <th>Time Created</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                if ($numrows > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $images = json_decode($row['images']);
                                                        $amenities = json_decode($row['amenities']);
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item update-status-btn" onclick="updateStatus(this)" item_id="<?php echo $row['item_id']; ?>" item_status="<?php echo $row['status']; ?>" item_name="<?php echo $row['title']; ?>" data-bs-toggle="modal" data-bs-target="#update_status_modal">Update Status</a></li>
                                                                        <li><a class="dropdown-item delete-item-btn" onclick="deleteItem(this)" item_id="<?php echo $row['item_id']; ?>" item_name="<?php echo $row['title']; ?>">Delete</a></li>

                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item">Close</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td><img style="width:100px;height:100px;object-fit:cover;" src="../item-images/<?php echo $images[0]; ?>" alt=""></td>
                                                            <td><?php echo $row['category']; ?></td>
                                                            <td><?php echo $row['item_type']; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['location']; ?></td>
                                                            <td><?php echo $row['item_condition']; ?></td>
                                                            <td><?php echo $row['nearest_bustop']; ?></td>
                                                            <td><?php echo $row['number_of_rooms']; ?></td>
                                                            <td><?php
                                                                foreach ($amenities as $amenity) {
                                                                    echo $amenity . ",";
                                                                }
                                                                ?></td>
                                                            <td><?php echo $row['number_of_toilets']; ?></td>
                                                            <td><span>&#8358</span><?php echo number_format($row['price']); ?></td>
                                                            <td><?php echo $row['number_of_bathrooms']; ?></td>
                                                            <td><?php echo $row['additional_information']; ?></td>
                                                            <td><?php echo $row['status']; ?></td>
                                                            <td><?php echo $row['time_created']; ?></td>

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










    <!--   Update Status Modal -->
    <div class="modal fade" id="update_status_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="">
                    <div class="modal-body">

                        <label>Name</label>
                        <input type="text" name="name" class="form-control mb-3 update-item-name" readonly required>

                        <label>Status</label>
                        <select name="status" id="" class="form-control update-item-status mb-3" required>
                            <option value="">[Please Select]</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>

                        <input type="hidden" name="item_id" class="update-item-id">


                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="update_status">Submit</button>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <!-- Page level plugins -->

    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script src="../assets/bootstrap5/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap5/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>


    <script>
        // $(".update-balance-btn").click(function() {

        //     $(".update-vendor-store-name").val($(this).attr("item_store_name"));
        //     $(".update-vendor-balance").val($(this).attr("item_balance"));
        //     $(".update-vendor-id").val($(this).attr("item_id"));


        // })


        // $(".update-status-btn").click(function() {

        //     $(".update-vendor-store-name").val($(this).attr("item_store_name"));
        //     $(".update-vendor-status").val($(this).attr("item_status"));
        //     $(".update-vendor-id").val($(this).attr("item_id"));


        // })

        // $(".delete-vendor-btn").click(function() {
        //     var store_name = $(this).attr("store_name");
        //     var item_id = $(this).attr("item_id");
        //     if (confirm(`Are you sure you want to delete ${store_name}?`)) {
        //         window.location.href = `./?delete_item&store_name=${store_name}&item_id=${item_id}`;
        //     } else {
        //         return false;
        //     }
        // })


        function updateStatus(item) {
            $(".update-item-name").val(item.getAttribute("item_name"));
            $(".update-item-status").val(item.getAttribute("item_status"));
            $(".update-item-id").val(item.getAttribute("item_id"));

        }

        function deleteItem(item) {
            var item_name = item.getAttribute("item_name");
            var item_id = item.getAttribute("item_id");
            if (confirm(`Are you sure you want to delete ${item_name}?`)) {
                window.location.href = `items?delete_item&&item_id=${item_id}`;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>