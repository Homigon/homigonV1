<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';
include 'classes/items.class.php';

if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];
}
if (!isset($_GET['i'])) {
    $admin->goTo("./", "invalid_item");
}
$item_id = mysqli_real_escape_string($db->conn, $_GET['i']);

if (!$item->itemIdExists($item_id)) {
    $admin->goTo("./", "invalid_item");
}

$user_id = $item->getDetail($item_id, "user_id");




if (isset($_GET['send_message'])) {
    $name = mysqli_real_escape_string($db->conn, $_GET['name']);
    $email = mysqli_real_escape_string($db->conn, $_GET['email']);
    $message = mysqli_real_escape_string($db->conn, $_GET['message']);

    $msg = "<b>Name: </b>$name <br> <b>Email: </b>$email <br> <b>Message: </b>$message <br>";

    // Send Email here..

    $admin->goTo("message-success", "i=$item_id");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/all.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="assets/fontawesome-free-6.4.0-web/css/all.css?v=<?php echo uniqid(); ?>">
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

    <!-- product starts -->
    <div class="product">

        <form action="product-listing" method="GET">
            <!-- input search -->
            <div class="input-search">
                <input type="search" name="query" id="" placeholder="Type your search here">
                <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
            </div>
            <!-- dropdowns -->

            <div class="dropdown">
                <div class="dropdown-options">
                    <div class="options">
                        <select name="category" id="category">
                            <option value="">All Categories</option>
                            <?php
                            $types = $admin->getCategories();
                            foreach ($types as $type) {
                                echo "<option>$type</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="options">
                        <select name="type" id="all-types">
                            <option value="">All Types</option>
                            <?php
                            $types = $admin->getTypes();
                            foreach ($types as $type) {
                                echo "<option>$type</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="options">
                        <select name="rooms" id="bedrooms">
                            <!-- <option value="bedrooms">Bedrooms</option>
                            <option value="0 bedroom">Single Room</option>
                            <option value="1 bedroom">1 bedroom</option>
                            <option value="2 bedroom">2 bedrooms</option>
                            <option value="3 bedroom">3 bedrooms</option>
                            <option value="4 bedroom">4 bedrooms and above</option> -->
                            <option value="">All Bedrooms</option>
                            <?php
                            for ($i = 0; $i < 1000; $i++) {
                                echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="searchbtn">
                        <button type="submit" style="color: #fff;">Search <i class="fa fa-search" aria-hidden="true" style="color: #fff;"></i></button>
                    </div>
                </div>

            </div>


        </form>

        <!-- breadcrumps -->
        <div class="breadcrumbs">
            <nav>
                <ul>
                    <li><a href="#URL"><?php echo $item->getDetail($item_id, "category"); ?></a></li>
                    <li><a href="#URL"><?php echo $item->getDetail($item_id, "item_type"); ?></a></li>
                    <li><?php echo $item->getDetail($item_id, "title"); ?></li>
                </ul>
            </nav>


        </div>

        <div class="listed-container">
            <div class="listed">
                <div class="img-container">
                    <?php
                    $images = json_decode($item->getDetail($item_id, "images"));
                    ?>
                    <div class="first-img">
                        <div class="img-box1">
                            <img src="item-images/<?php echo $images[0]; ?>" alt="" class="img1 item-main-image">
                        </div>
                    </div>

                    <div class="owl-carousel owl-theme other-img">
                        <?php
                        foreach ($images as $image) {

                        ?>
                            <div class="item img-box">
                                <img src="item-images/<?php echo $image; ?>" alt="" class="img2 item-other-image" image="<?php echo $image; ?>">
                            </div>
                        <?php

                        }
                        ?>
                        <!-- <div class="img-box">
                            <img src="assets/img/Rectangle 213-2.png" alt="" class="img2">
                        </div>
                        <div class="img-box">
                            <img src="assets/img/Rectangle 213-2.png" alt="" class="img3">
                        </div>
                        <div class="img-box">
                            <img src="assets/img/Rectangle 213-2.png" alt="" class="img4">
                        </div> -->
                    </div>


                </div>
                <div class="details">
                    <p><?php echo $item->getDetail($item_id, "title"); ?></p>
                    <div class="price" id="price">&#8358; <?php echo number_format($item->getDetail($item_id, "price")); ?></div>
                    <!-- time loction -->
                    <div class="time-location">
                        <div class="location-time">
                            <div class="product-location" id="product-location">
                                <div class="img"><img src="assets/img/location.svg" alt=""></div>
                                <p><?php echo $item->getDetail($item_id, "location"); ?></p>
                            </div>
                            <div class="time" id="time-posted">
                                <div class="img"><img src="assets/img/Vector.png" alt=""></div>
                                <p> Posted <?php
                                            // print_r($item->getDetail($item_id, "time"));
                                            echo $db->format_time($item->getDetail($item_id, "time"))['time'] . " " . $db->format_time($item->getDetail($item_id, "time"))['time_frame']
                                            ?> ago</p>
                            </div>
                        </div>
                    </div>
                    <!-- number of toilets/bthroom/bedrooms -->
                    <div class="icons_and_more_description">
                        <div class="bed-icon">
                            <div class="bed-icon-img">
                                <img src="assets/img/bed-icon.png">
                            </div>
                            <p>4</p>
                        </div>
                        <div class="bed-icon">
                            <div class="bed-icon-img">
                                <img src="assets/img/bathtub-icon.png">
                            </div>
                            <p>4</p>
                        </div>
                        <div class="bed-icon">
                            <div class="bed-icon-img">
                                <img src="assets/img/bathroom-icon.png">
                            </div>
                            <p>4</p>
                        </div>

                    </div>

                </div>

                <!-- descriptions -->
                <div class="descriptions">
                    <p>Description</p>
                    <p>Location <span id="precise-location" class="small"><?php echo $item->getDetail($item_id, "location"); ?></span></p>
                    <p>Closest-bustop <span id="closest-bustop" class="small"><?php echo $item->getDetail($item_id, "nearest_bustop"); ?></span></p>
                    <p>Condition <span id="condition" class="small"><?php echo $item->getDetail($item_id, "item_condition"); ?></span></p>
                    <div id="amenities">Amenities<span class="small">
                            <?php
                            $amenities = json_decode($item->getDetail($item_id, "amenities"));
                            foreach ($amenities as $amenity) {
                            ?>
                                <p class="small amenity"><?php echo $amenity; ?></p>
                            <?php
                            }
                            ?>

                        </span></div>
                    <p>Additional information <span class="small" id="additional-information"><?php echo $item->getDetail($item_id, "additional_information"); ?></span></p>
                </div>

                <div class="call-agent">
                    <div class="button"><a href="tel:<?php echo $user->getDetail($user_id, "phone"); ?>">Call Agent</a></div>
                    <div class="button"><a class="message-agent-btn" style="color: #333;" data-bs-toggle="modal" data-bs-target="#send_message_modal">Message Agent</a></div>
                </div>

                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <div class="save-for-later save-for-later-logged-in">
                        <div class="img">

                            <i class="fa fa-heart save-item-heart <?php if ($user->haveSavedItem($item_id, $session_id)) {
                                                                        echo "green";
                                                                    } else {
                                                                        echo "outline-green";
                                                                    } ?>"></i>
                        </div>
                        <div>
                            <p>Save for later</p>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="save-for-later" data-bs-toggle="modal" data-bs-target="#save_for_later_not_logged_in_modal">
                        <div class="img">

                            <i class="fa fa-heart outline-green"></i>
                        </div>
                        <div>
                            <p>Save for later</p>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>

            <div class="contact-agent">

                <div class="details-rating">

                    <div class="agent-details">
                        <div>
                            <p>Agent details</p>
                            <p id="name" style="font-weight: 300;"><?php echo $user->getDetail($user_id, "firstname") . " " . $user->getDetail($user_id, "lastname"); ?></p>
                        </div>

                        <div class="call-agent">
                            <div class="button"><a href="tel:<?php echo $user->getDetail($user_id, "phone"); ?>">Call Agent</a></div>
                            <div class="button"><a class="message-agent-btn" style="color: #333;" data-bs-toggle="modal" data-bs-target="#send_message_modal">Message Agent</a></div>
                        </div>

                    </div>

                    <!-- <div class="agent-rating-reviews">
                        <p style="font-weight: 700; font-size: 16px;">Agent Rating and Reviews</p>
                        <div class="agent-rating">
                            <p>username</p>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked "></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div> -->
                </div>

                <div class="similar-houses">
                    <?php
                    $title = $item->getDetail($item_id, "title");
                    $price = $item->getDetail($item_id, "price");
                    $location = $item->getDetail($item_id, "location");

                    $result = $db->setQuery("SELECT * FROM items WHERE title LIKE '%$title%' OR price LIKE '%$price%' OR location LIKE '%$location%' ORDER BY id DESC LIMIT 8;");
                    $numrows = mysqli_num_rows($result);

                    if ($numrows > 0) {
                        echo "<p>Similar Houses</p>";
                    ?>

                        <div class="similar-houses-box">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['item_id'] != $item_id) {
                                    $images = json_decode($row['images']);
                            ?>
                                    <a href="product?i=<?php echo $row['item_id']; ?>">
                                        <div class="body">
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
                            }
                        }
                        ?>


                        </div>


                </div>
            </div>
        </div>



        <!-- Send Mesage Modal -->
        <div class="modal fade" id="send_message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:mediumseagreen;">Send Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="GET">
                        <div class="modal-body">

                            <input type="hidden" name="i" value="<?php echo $item_id; ?>">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control mb-2" required>

                            <label>Email</label>
                            <input type="email" name="email" class="form-control mb-2" required>

                            <label>Message</label>
                            <textarea name="message" style="height:150px;" class="form-control mb-2" required></textarea>



                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-warning" name="send_message">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Save for later not logged in Modal -->
        <div class="modal fade" id="save_for_later_not_logged_in_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:mediumseagreen;">Please Log In</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <p><i>You have to <a href="sign-in?i=<?php echo $item_id; ?>">login</a> or <a href="create-account?i=<?php echo $item_id; ?>">Sign up</a> to save this item</i></p>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>

                    </div>

                </div>
            </div>
        </div>



    </div>
    <!-- product ends -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script defer src="assets/js/all.min.js"></script>
    <!-- <script defer src="assets/js/fontawesome.min.js"></script> -->
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/product.js"></script>
    <script defer src="assets/js/main.js"></script>

    <script>
        $(".item-other-image").click(function() {
            var image = $(this).attr("image");
            $(".item-main-image").attr("src", "item-images/" + image);
        })

        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })




        $(".save-for-later-logged-in").click(function() {
            saveItem();
        })

        function saveItem() {
            var item_id = "<?php echo $item_id ?>";
            $.ajax({

                url: "ajax.php",
                method: "POST",
                async: true,
                data: {
                    "save_item": "yes",
                    item_id
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Saved") {
                        $(".save-item-heart").removeClass("outline-green")
                        $(".save-item-heart").addClass("green")
                        alert("Saved");
                    } else if (data == "unSaved") {
                        $(".save-item-heart").removeClass("green")
                        $(".save-item-heart").addClass("outline-green")
                    }
                }

            });
        }
    </script>
</body>

</html>