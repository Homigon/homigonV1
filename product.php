<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';
include 'classes/items.class.php';

if (!isset($_GET['i'])) {
    $admin->goTo("./", "invalid_item");
}
$item_id = mysqli_real_escape_string($db->conn, $_GET['i']);

if (!$item->itemIdExists($item_id)) {
    $admin->goTo("./", "invalid_item");
}

$user_id = $item->getDetail($item_id, "user_id");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/agent-signup-and-create-account.css">
    <link rel="stylesheet" href="assets/css/sign-in.css">
    <link rel="stylesheet" href="assets/css/agent-account.css">
    <link rel="stylesheet" href="assets/css/list-a-house.css">
    <link rel="stylesheet" href="assets/css/list-a-house2.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/product-listing.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <!-- navbar starts -->

    <?php include 'header.php'; ?>



    <!-- navbar ends -->

    <!-- product starts -->
    <div class="product">
        <form action="" method="get">

            <!-- input search -->
            <div class="input-search">
                <input type="search" name="" id="" placeholder="Type your search here">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>


            <!-- dropdowns -->

            <div class="dropdown">
                <div class="dropdown-options">
                    <div class="options">
                        <select name="category" id="category">
                            <option value="category">Category</option>
                            <option value="buy">Buy</option>
                            <option value="rent">Rent</option>
                            <option value="lease">Lease</option>
                        </select>
                    </div>

                    <div class="options">
                        <select name="all-types" id="all-types">
                            <option value="All types">All Types</option>
                            <option value="flat">Flat</option>
                            <option value="studio-apartment">Studio-Apartment</option>
                            <option value="boys-quarters">Boys Quarters</option>
                        </select>
                    </div>

                    <div class="options">
                        <select name="bedrooms" id="bedrooms">
                            <option value="bedrooms">Bedrooms</option>
                            <option value="0 bedroom">Single Room</option>
                            <option value="1 bedroom">1 bedroom</option>
                            <option value="2 bedroom">2 bedrooms</option>
                            <option value="3 bedroom">3 bedrooms</option>
                            <option value="4 bedroom">4 bedrooms and above</option>
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

                    <div class="other-img">
                        <?php
                        foreach ($images as $image) {

                        ?>
                            <div class="img-box">
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
                                <p> Posted <?php echo $db->format_time($item->getDetail($item_id, "time"))['time'] . " " . $db->format_time($item->getDetail($item_id, "time"))['time_frame']
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
                                <p class="small"><?php echo $amenity; ?></p>
                            <?php
                            }
                            ?>

                        </span></div>
                    <p>Additional information <span class="small" id="additional-information"><?php echo $item->getDetail($item_id, "additional_information"); ?></span></p>
                </div>

                <div class="call-agent">
                    <div class="button"><a href="tel:<?php echo $user->getDetail($user_id, "phone"); ?>">Call Agent</a></div>
                    <div class="button"><a class="message-agent-btn" style="color: #333;">Message Agent</a></div>
                </div>

                <div class="save-for-later">
                    <div class="img">
                        <img src="assets/img/Vector (5).png" alt="">
                    </div>
                    <div>
                        <p>Save for later</p>
                    </div>
                </div>
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
                            <div class="button"><a class="message-agent-btn" style="color: #333;">Message Agent</a></div>
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
                    $result = $db->setQuery("SELECT * FROM items ORDER BY id DESC LIMIT 8;");
                    $numrows = mysqli_num_rows($result);

                    if ($numrows > 0) {
                        echo "<p>Similar Houses</p>";
                    ?>

                        <div class="similar-houses-box">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
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
                        ?>


                        </div>


                </div>
            </div>
        </div>

    </div>
    <!-- product ends -->

    <script src="assets/js/jquery.min.js"></script>
    <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/product.js"></script>
    <script defer src="assets/js/main.js"></script>

    <script>
        $(".item-other-image").click(function() {
            var image = $(this).attr("image");
            $(".item-main-image").attr("src", "item-images/" + image);
        })
    </script>
</body>

</html>