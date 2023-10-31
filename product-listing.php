<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';
include 'classes/items.class.php';

if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product listing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/all.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/agent-signup-and-create-account.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/sign-in.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/agent-account.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/list-a-house.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/list-a-house2.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/faq.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/product.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/product-listing.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo uniqid(); ?>">
</head>

<body>
    <!-- navbar starts -->
    <?php include 'header.php'; ?>
    <!-- navbar ends -->


    <!-- product listing starts -->
    <div class="product-listing">
        <!-- input search -->
        <div class="input">
            <form action="" method="get">
                <input type="search" name="query" id="" placeholder="Type your search here">
                <button><i type="submit" class="fa fa-search"></i></button>
            </form>

        </div>

        <!-- <h6>Houses for Rent</h6> -->

        <!-- house-filter -->
        <div class="house-filter">
            <div class="filter">
                <div class="filter-container">
                    <div class="filter-text">
                        <p>Filter<span style="margin-left: 10px;"><i class="fa fa-sliders"></i></span></p>
                    </div>
                    <form action="product-listing" method="GET">

                        <div class="category">
                            <h6 style="margin-bottom:20px;">Category</h6>
                            <?php
                            $categories = $admin->getCategories();
                            if (isset($_GET['category'])) {
                                $category = $_GET['category'];
                            } else {
                                $category = [];
                            }
                            ?>
                            <?php
                            foreach ($categories as $c) {
                            ?>
                                <div class="<?php echo $c ?>" style="margin-bottom:30px;">
                                    <input type="checkbox" name="category[]" value="<?php echo $c ?>" <?php if (in_array($c, $category)) {
                                                                                                            echo "checked";
                                                                                                        } ?> id="<?php echo $c ?>">
                                    <label for="<?php echo $c ?>"><?php echo $c ?></label>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="type-of-house">
                            <h6>Type of House</h6>
                            <?php
                            $types = $admin->getTypes();
                            if (isset($_GET['type'])) {
                                $type = $_GET['type'];
                            } else {
                                $type = [];
                            }
                            ?>

                            <?php
                            foreach ($types as $t) {
                            ?>
                                <div class="flat">
                                    <input type="checkbox" name="type[]" value="<?php echo $t; ?>" <?php if (in_array($t, $type)) {
                                                                                                        echo "checked";
                                                                                                    } ?> id="<?php echo $t; ?>">
                                    <label for="<?php echo $t; ?>"><?php echo $t; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- 
                            <div class="flat">
                                <input type="checkbox" name="type[]" value="Flat" id="flat">
                                <label for="flat">Flat</label>
                            </div>
                            <div class="boys-quarters">
                                <input type="checkbox" name="type[]" value="Boys Quarter" id="boys-quarters">
                                <label for="boys-quarters">Boys Quarters</label>
                            </div>
                            <div class="studio-apartment">
                                <input type="checkbox" name="type[]" value="Studio Apartment" id="studio-apartment">
                                <label for="studio-apartment">Studio Apartment</label>
                            </div> -->
                        </div>

                        <div class="button">
                            <button name="filter">Apply filter</button>
                        </div>

                    </form>

                    <h6 class="seemore" id="seemore" onclick="openfiltermodal()">More Options <i class="fa fa-angle-double-right" aria-hidden="true" style="margin-top:2px;margin-left:2px;"></i></h6>
                </div>
                <p class="filter-icon" id="filter-icon">Filter<span style="margin-left: 10px;"><i class="fa fa-sliders"></i></span></p>
            </div>
            <div class="houses-listing">
                <!-- <div class="houses-listed"> -->

                <?php
                $options = "WHERE status='Active'";
                $parameters = "";

                if (isset($_GET['page']) and is_numeric($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $limit = 10;
                $offset = ($page - 1) * $limit;

                // print_r($_GET['category']);
                if (isset($_GET['category']) and $_GET['category'] != "" and is_array($_GET['category']) and $_GET['category'][0] != "") {

                    // if (is_array($_GET['category'])) {
                    $options .= " AND ";
                    $x = 0;
                    $count = count($_GET['category']);
                    foreach ($_GET['category'] as $category) {
                        $category = mysqli_real_escape_string($db->conn, $category);
                        if ($x < ($count - 1)) {
                            $options .= " category='$category' OR ";
                        } else {
                            $options .= " category='$category' ";
                        }
                        $x++;
                        $parameters .= "&category[]=" . $category;
                    }

                    // } else {
                    //     $category = mysqli_real_escape_string($db->conn, $_GET['category']);
                    //     $options .= " AND category='$category' ";
                    // }
                }


                if (isset($_GET['type']) and $_GET['type'] != "" and is_array($_GET['type']) and $_GET['type'][0] != "") {

                    // if (is_array($_GET['type'])) {
                    $options .= " AND ";
                    $x = 0;
                    $count = count($_GET['type']);
                    foreach ($_GET['type'] as $item_type) {
                        $item_type = mysqli_real_escape_string($db->conn, $item_type);
                        if ($x < ($count - 1)) {
                            $options .= " item_type='$item_type' OR ";
                        } else {
                            $options .= " item_type='$item_type' ";
                        }
                        $x++;
                        $parameters .= "&type[]=" . $item_type;
                    }

                    // } else {
                    //     $item_type = mysqli_real_escape_string($db->conn, $_GET['type']);
                    //     $options .= " AND item_type='$item_type' ";
                    // }
                }

                if (isset($_GET['rooms']) and $_GET['rooms'] != "") {
                    $number_of_rooms = mysqli_real_escape_string($db->conn, $_GET['rooms']);
                    $options .= " AND number_of_rooms='$number_of_rooms' ";
                    $parameters .= "&rooms=" . $_GET['rooms'];
                }



                if (isset($_GET['bathrooms']) and $_GET['bathrooms'] != "") {
                    $number_of_bathrooms = mysqli_real_escape_string($db->conn, $_GET['bathrooms']);
                    $options .= " AND number_of_bathrooms='$number_of_bathrooms' ";
                    $parameters .= "&bathrooms=" . $_GET['bathrooms'];
                }

                if (isset($_GET['toilets']) and $_GET['toilets'] != "") {
                    $number_of_toilets = mysqli_real_escape_string($db->conn, $_GET['toilets']);
                    $options .= " AND number_of_toilets='$number_of_toilets' ";
                    $parameters .= "&toilets=" . $_GET['toilets'];
                }

                if (isset($_GET['location']) and $_GET['location'] != "") {
                    $location = mysqli_real_escape_string($db->conn, $_GET['location']);
                    $options .= " AND location LIKE '%$location%' ";
                    $parameters .= "&location=" . $_GET['location'];
                }

                if (isset($_GET['query']) and $_GET['query'] != "") {
                    $query = mysqli_real_escape_string($db->conn, $_GET['query']);
                    $options .= " AND title LIKE '%$query%' OR location LIKE '%$query%' ";
                    $parameters .= "&query=" . $_GET['query'];
                }

                if (isset($_GET['price_range']) and $_GET['price_range'] != "") {
                    $price_range = mysqli_real_escape_string($db->conn, $_GET['price_range']);
                    $pr = explode("-", $price_range);
                    $from = $pr[0];
                    $to = $pr[1];
                    $options .= " AND price >= $from AND price <= $to ";
                    $parameters .= "&price_range=" . $_GET['price_range'];
                }

                $result = $db->setQuery("SELECT * FROM items $options LIMIT $offset,$limit;");
                $numrows = mysqli_num_rows($result);

                if ($numrows > 0) {
                    if ($numrows == 1) {
                        echo "<p style='font-size:20px;color:#33CCA8;width:100%;text-align:center;'>$numrows result found.</p>";
                    } else {
                        echo "<p style='font-size:20px;color:#33CCA8;width:100%;text-align:center;font-weight:600;'><i>$numrows results found.</i></p>";
                    }
                ?>
                    <div class="houses-listed">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $images = json_decode($row['images']);
                        ?>
                            <a href="product?i=<?php echo $row['item_id']; ?>">
                                <div href="product?i=<?php echo $row['item_id']; ?>" class="body">

                                    <div class="img">
                                        <img src="item-images/<?php echo $images[0]; ?>" alt="">
                                        <div class="icon-price">
                                            <div class="icons_and_more_description">
                                                <div class="bed-icon">
                                                    <div class="bed-icon-img">
                                                        <img src="assets/img/bed-icon.png">
                                                    </div>
                                                    <p><?php echo $row['number_of_rooms']; ?></p>
                                                </div>
                                                <div class="bed-icon">
                                                    <div class="bed-icon-img">
                                                        <img src="assets/img/bathtub-icon.png">
                                                    </div>
                                                    <p><?php echo $row['number_of_bathrooms']; ?></p>
                                                </div>
                                                <div class="bed-icon">
                                                    <div class="bed-icon-img">
                                                        <img src="assets/img/bathroom-icon.png">
                                                    </div>
                                                    <p><?php echo $row['number_of_toilets']; ?></p>
                                                </div>

                                            </div>
                                            <div class="price"><span>&#8358;</span><?php echo number_format($row['price']); ?></div>
                                        </div>

                                    </div>

                                    <div class="description">
                                        <p style="font-weight: 700;"><?php echo $row['title']; ?></p>
                                        <div class="location-and-time-listed">
                                            <div><img src="assets/img/location.svg">
                                                <p><?php echo $row['location']; ?></p>
                                            </div>
                                            <!-- <div><img src="assets/img/Vector.png" alt=""><p>2hrs</p></div> -->
                                        </div>
                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                <?php
                } else {
                    echo "<div style='width:100%;margin-top:10px;'>
                            <div style='width:100%;text-align:center;margin-bottom:20px;'>
                                 <i class='fa fa-search' style='font-size:100px;color:#33CCA8;opacity:0.8;'></i>
                            </div>
                            <p style='color:lightgrey;font-size:23px;text-align:center;'>No Items Found!</p>
                        </div>";
                }
                ?>


                <p class="seemore-navigation">
                    <?php
                    $next_page = $page + 1;
                    $previous_page = $page - 1;
                    ?>
                    <?php
                    if ($page != 1) {
                        echo "<a href='product-listing?page=$previous_page$parameters' class='previous'><i class='fa fa-angle-double-left'></i> Previous</a>";
                    }
                    ?>
                    <a class='page'>(Page <?php echo $page; ?>) </a>
                    <?php
                    if ($numrows >= $limit) {
                        echo "<a href='product-listing?page=$next_page$parameters' class='next'>Next <i class='fa fa-angle-double-right'></i></a>";
                    }
                    ?>

                </p>

            </div>

        </div>
        <!-- <p class="seemore">
            <a href='product-listing' class='previous'><i class='fa fa-angle-double-left'></i> Previous</a>
            <a href='product-listing'>Next <i class='fa fa-angle-double-right'></i></a>
        </p> -->


        <!-- filter modal -->

        <div class="filter-modal" id="filter-modal">
            <div class="filter-box">
                <div class="filter-text">
                    <p>Filter<span style="margin-left: 10px;"><i class="fa fa-sliders"></i></span></p>
                </div>
                <form action="product-listing" method="GET">
                    <div class="filter-items">
                        <div class="items">
                            <h6>Category</h6>
                            <?php
                            $categories = $admin->getCategories();
                            if (isset($_GET['category'])) {
                                $category = $_GET['category'];
                            } else {
                                $category = [];
                            }
                            ?>
                            <?php
                            foreach ($categories as $c) {
                            ?>
                                <div class="item1">
                                    <input type="checkbox" name="category[]" <?php if (in_array($c, $category)) {
                                                                                    echo "checked";
                                                                                } ?> value="<?php echo $c; ?>" id="<?php echo $c; ?>">
                                    <label for="<?php echo $c; ?>"><?php echo $c; ?></label>
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                        <div class="items">
                            <h6>Number of bedrooms</h6>
                            <select name="rooms" class="form-control">
                                <option value="">[Select Bedrooms]</option>
                                <option value="">Any</option>
                                <?php
                                for ($i = 1; $i < 1000; $i++) {
                                    $rooms = $_GET['rooms'];
                                    if ($rooms == $i) {
                                        echo "<option selected>$i</option>";
                                    } else {
                                        echo "<option>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                            <!-- <div class="item1">
                                <input type="checkbox" name="one-bedroom" id="one-bedroom">
                                <label for="one-bedroom">1 bedroom</label>
                            </div>
                            <div class="item2">
                                <input type="checkbox" name="two-bedroom" id="two-bedroom">
                                <label for="two-bedroom">2 bedrooms</label>
                            </div>
                            <div class="item3">
                                <input type="checkbox" name="three-bedroom" id="three-bedroom">
                                <label for="three-bedrooms">3 bedrooms</label>
                            </div>
                            <div class="item4">
                                <input type="checkbox" name="four-bedroom" id="four-bedroom">
                                <label for="four-bedrooms">4 bedrooms +</label>
                            </div> -->
                        </div>

                        <div class="items">
                            <h6>Type of House</h6>
                            <?php
                            $types = $admin->getTypes();
                            if (isset($_GET['type'])) {
                                $type = $_GET['type'];
                            } else {
                                $type = [];
                            }
                            ?>

                            <?php
                            foreach ($types as $t) {
                            ?>
                                <div class="item1">
                                    <input type="checkbox" name="type[]" value="<?php echo $t; ?>" <?php if (in_array($t, $type)) {
                                                                                                        echo "checked";
                                                                                                    } ?> id="<?php echo $t; ?>">
                                    <label for="flat2"><?php echo $t; ?></label>
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                        <div class="items">
                            <h6>Number of Toilets</h6>
                            <select name="toilets" class="form-control">
                                <option value="">[Select Toilets]</option>
                                <option value="">Any</option>
                                <?php
                                for ($i = 1; $i < 1000; $i++) {
                                    $toilets = $_GET['toilets'];
                                    if ($toilets == $i) {
                                        echo "<option selected>$i</option>";
                                    } else {
                                        echo "<option>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                            <!-- <div class="item1">
                                <input type="checkbox" name="one-toilet" id="one-toilet">
                                <label for="one-toilet">1 Toilet</label>
                            </div>
                            <div class="item2">
                                <input type="checkbox" name="two-toilets" id="two-toilets">
                                <label for="two-toilets">2 Toilets</label>
                            </div>
                            <div class="item3">
                                <input type="checkbox" name="three-toilet" id="three-toilet">
                                <label for="three-toilet">3 Toilets</label>
                            </div>
                            <div class="item4">
                                <input type="checkbox" name="four-toilet" id="four-toilet">
                                <label for="four-toilet">4 Toilets +</label>
                            </div> -->


                        </div>

                        <div class="items">
                            <h6>Number of bathrooms</h6>
                            <select name="bathrooms" class="form-control">
                                <option value="">[Select Bathrooms]</option>
                                <option value="">Any</option>
                                <?php
                                for ($i = 1; $i < 1000; $i++) {
                                    $bathrooms = $_GET['bathrooms'];
                                    if ($bathrooms == $i) {
                                        echo "<option selected>$i</option>";
                                    } else {
                                        echo "<option>$i</option>";
                                    }
                                }
                                ?>
                            </select>
                            <!-- <div class="item1">
                                <input type="checkbox" name="one-bathroom" id="one-bathroom">
                                <label for="one-bathroom">1 bathroom</label>
                            </div>
                            <div class="item2">
                                <input type="checkbox" name="two-bathrooms" id="two-bathrooms">
                                <label for="two-bathrooms">2 bathrooms</label>
                            </div>
                            <div class="item3">
                                <input type="checkbox" name="three-bathroom" id="three-bathroom">
                                <label for="three-bathroom">3 bathrooms</label>
                            </div>
                            <div class="item4">
                                <input type="checkbox" name="four-bathroom" id="four-bathroom">
                                <label for="four-bathroom">4 bathrooms +</label>
                            </div> -->


                        </div>
                        <div class="button">
                            <input type="submit" value="Apply Filter">
                        </div>

                    </div>


                </form>

            </div>

        </div>


    </div>

    </div>
    <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/product-listing.js"></script>
    <script defer src="assets/js/main.js"></script>


</body>

</html>