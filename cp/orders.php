<?php
session_start();
include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/vendors.class.php';
include '../classes/menu.class.php';
include '../classes/orders.class.php';


if (!isset($_SESSION['admin_id'])) {
    $admin->goTo("login", "invalid_admin");
}
$admin_id = $_SESSION['admin_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .ordered-products-container {
            position: relative;
            width: 100%;
            display: flex;
            flex-flow: row wrap;
        }

        .ordered-products-container .box {
            position: relative;
            width: 100%;
            display: flex;
            flex-flow: row nowrap;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .ordered-products-container .box .row1 {
            position: relative;
            margin-right: 20px;
        }


        .ordered-products-container .box .row1 .image {
            position: relative;
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .ordered-products-container .box .row2 {
            position: relative;
        }

        .ordered-products-container .box .row2 .name {
            position: relative;
            font-size: 15px;
            color: #B11928;
        }

        .ordered-products-container .box .row2 .price {
            position: relative;
            font-size: 14px;
            color: black;
        }

        .ordered-products-container .box .row2 .quantity {
            position: relative;
            font-size: 14px;
            color: grey;
        }
    </style>
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
                        <h1 class="h3 mb-0 text-gray-800">Orders</h1>

                    </div>


                    <div class="row">
                        <?php
                        $result = $db->setQuery("SELECT * FROM orders;");
                        $numrows = mysqli_num_rows($result);
                        ?>
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Orders (<?php echo $numrows; ?>)</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Vendor</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                if ($numrows > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row['order_id'];  ?></td>
                                                            <td><?php echo $vendor->getDetail($row['vendor_id'], "store_name"); ?></td>
                                                            <td><span>&#8358</span><?php echo number_format($row['price']);  ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item view-products-btn" onclick="viewProducts(this)" data-bs-toggle="modal" data-bs-target="#view_products_modal" order_id="<?php echo $row['order_id']; ?>">View Products</a></li>
                                                                        <li><a class="dropdown-item view-customer-btn" onclick="viewCustomer(this)" data-bs-toggle="modal" data-bs-target="#view_customer_modal" order_id="<?php echo $row['order_id']; ?>">Customer Details</a></li>
                                                                        <li><a class="dropdown-item view-price-btn" onclick="viewPrice(this)" data-bs-toggle="modal" data-bs-target="#view_price_modal" order_id="<?php echo $row['order_id']; ?>">Price Details</a></li>

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



    <!--   View products Modal -->
    <div class="modal fade" id="view_products_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ordered Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="ordered-products-container">

                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <!-- <button type="submit" class="btn btn-primary" name="edit_coin">Submit</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>




    <!--   View Customer Modal -->
    <div class="modal fade" id="view_customer_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <label>Name</label>
                    <input type="text" class="form-control mb-3 view-customer-name" readonly>

                    <label>Phone</label>
                    <input type="text" class="form-control mb-3 view-customer-phone" readonly>

                    <label>Location</label>
                    <input type="text" class="form-control mb-3 view-customer-location" readonly>

                    <label>Address</label>
                    <input type="text" class="form-control mb-3 view-customer-address" readonly>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <!-- <button type="submit" class="btn btn-primary" name="edit_coin">Submit</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>



    <!--   View price Modal -->
    <div class="modal fade" id="view_price_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Price Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <label>Subtotal</label>
                    <input type="text" class="form-control mb-3 view-price-subtotal" readonly>

                    <label>Delivery Price</label>
                    <input type="text" class="form-control mb-3 view-price-delivery-price" readonly>

                    <label>Pack Price</label>
                    <input type="text" class="form-control mb-3 view-price-pack-price" readonly>

                    <label>Charges</label>
                    <input type="text" class="form-control mb-3 view-price-charges" readonly>

                    <label>Total Price</label>
                    <input type="text" class="form-control mb-3 view-price-total-price" readonly>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <!-- <button type="submit" class="btn btn-primary" name="edit_coin">Submit</button> -->
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
        // $(".view-products-btn").click(function() {
        //     var order_id = $(this).attr("order_id");
        //     $.ajax({

        //         url: "../ajax-get-ordered-products.php",
        //         method: "POST",
        //         async: false,
        //         data: {
        //             "get_ordered_products": "yes",
        //             order_id
        //         },
        //         success: function(data) {

        //             $(".ordered-products-container").html(data);
        //         }

        //     });
        // })



        // $(".view-customer-btn").click(function() {
        //     var order_id = $(this).attr("order_id");
        //     $.ajax({

        //         url: "../ajax-get-ordered-products.php",
        //         method: "POST",
        //         async: false,
        //         data: {
        //             "get_customer_details": "yes",
        //             order_id
        //         },
        //         success: function(data) {
        //             console.log(data)
        //             var data = JSON.parse(data);
        //             $(".view-customer-name").val(data.name);
        //             $(".view-customer-phone").val(data.phone);
        //             $(".view-customer-location").val(data.location);
        //             $(".view-customer-address").val(data.address);
        //         }

        //     });
        // })



        // $(".view-price-btn").click(function() {
        //     var order_id = $(this).attr("order_id");
        //     $.ajax({

        //         url: "../ajax-get-ordered-products.php",
        //         method: "POST",
        //         async: false,
        //         data: {
        //             "get_price_details": "yes",
        //             order_id
        //         },
        //         success: function(data) {
        //             console.log(data)
        //             var data = JSON.parse(data);
        //             $(".view-price-subtotal").val("N" + data.subtotal);
        //             $(".view-price-delivery-price").val("N" + data.delivery_price);
        //             $(".view-price-pack-price").val("N" + data.pack_price);
        //             $(".view-price-charges").val("N" + data.charges);
        //             $(".view-price-total-price").val("N" + data.total_price);
        //         }

        //     });
        // })




        function viewProducts(order) {
            var order_id = order.getAttribute("order_id");
            $.ajax({

                url: "../ajax-get-ordered-products.php",
                method: "POST",
                async: false,
                data: {
                    "get_ordered_products": "yes",
                    order_id
                },
                success: function(data) {

                    $(".ordered-products-container").html(data);
                }

            });
        }

        function viewCustomer(order) {
            var order_id = order.getAttribute("order_id");
            $.ajax({

                url: "../ajax-get-ordered-products.php",
                method: "POST",
                async: false,
                data: {
                    "get_customer_details": "yes",
                    order_id
                },
                success: function(data) {
                    console.log(data)
                    var data = JSON.parse(data);
                    $(".view-customer-name").val(data.name);
                    $(".view-customer-phone").val(data.phone);
                    $(".view-customer-location").val(data.location);
                    $(".view-customer-address").val(data.address);
                }

            });
        }

        function viewPrice(order) {
            var order_id = order.getAttribute("order_id");
            $.ajax({

                url: "../ajax-get-ordered-products.php",
                method: "POST",
                async: false,
                data: {
                    "get_price_details": "yes",
                    order_id
                },
                success: function(data) {
                    // console.log(data)
                    var data = JSON.parse(data);
                    $(".view-price-subtotal").val("N" + data.subtotal);
                    $(".view-price-delivery-price").val("N" + data.delivery_price);
                    $(".view-price-pack-price").val("N" + data.pack_price);
                    $(".view-price-charges").val("N" + data.charges);
                    $(".view-price-total-price").val("N" + data.total_price);
                }

            });
        }
    </script>
</body>

</html>