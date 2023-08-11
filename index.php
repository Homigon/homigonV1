<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';
include 'classes/items.class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homigon</title>
    <link rel="icon" href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="assets/css/agent-signup-and-create-account.css">
    <link rel="stylesheet" href="assets/css/sign-in.css">
    <link rel="stylesheet" href="assets/css/agent-account.css">
    <link rel="stylesheet" href="assets/css/list-a-house.css">
    <link rel="stylesheet" href="assets/css/list-a-house2.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/product-listing.css"> -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body id="class">

    <!-- navbar starts -->
    <?php include 'header.php'; ?>

    <!-- navbar ends -->





    <!-- hero-section starts -->



    <div class="hero" id="hero">
        <div class="hero-content">



            <div class="head">
                <h3>House Hunting Made Easy, Find Your Dream Home!</h3>
                <p>Buy or rent your home at the best price</p>
            </div>

            <form action="product-listing" method="GET">

                <div class="buy-rent-lease">

                    <input type="radio" name="category[]" value="Buy" id="radio1">
                    <label for="radio1" class="radio-btn">Buy</label>
                    <input type="radio" name="category[]" value="Rent" id="radio2">
                    <label for="radio2" class="radio-btn">Rent</label>
                    <input type="radio" name="category[]" value="Lease" id="radio3">
                    <label for="radio3" class="radio-btn">Lease</label>
                    <!-- <button class="buy hero-btn" onclick="changeColor(this)">Buy</button>
                <button class="rent hero-btn" onclick="changeColor(this)">Rent</button>
                <button class="lease hero-btn" onclick="changeColor(this)">Lease</button> -->
                </div>

                <div class="searchbar">
                    <input type="search" name="query" placeholder="Enter a location, local goverment or street">
                </div>

                <div class="dropdown">
                    <div class="dropdown-options">

                        <div class="options">
                            <select name="type[]" id="all-types">
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
                            <select name="bedrooms" id="bedrooms">
                                <option value="">All Bedrooms</option>
                                <?php
                                for ($i = 0; $i < 100; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="options">
                            <select name="price_range" id="price-range">
                                <option value="">All Prices</option>
                                <option value="70000-100000">&#8358; 70,000 - &#8358; 100,000</option>
                                <option value="100000-150000">&#8358; 100,000 - &#8358; 150,000 </option>
                                <option value="150000-200000">&#8358; 150,000 - &#8358; 200,000</option>
                                <option value="200000-500000">&#8358; 200,000 - &#8358; 500,000</option>
                                <option value="500000-1000000">&#8358; 500,000 - &#8358; 1 million</option>
                                <option value="1000000-1000000000">1 million and above</option>
                            </select>
                        </div>


                        <div class="search-button">
                            <input type="submit" value="Search">
                            <!-- <i class="far fa-search"></i> -->
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- hero-section ends -->

    <!-- sub section -->
    <div class="sub-hero">
        <div class="item">
            <div class="icon"><img src="assets/img/Vector (6).png"></div>
            <div>
                <p>Get connected with avaliable houses </p>
            </div>
        </div>
        <div class="item">
            <div class="icon"><img src="assets/img/Vector (7).png"></div>
            <div>
                <p>Spend less time finding a house and more time moving in. Only inspect houses you find attractive </p>
            </div>
        </div>
        <div class="item">
            <div class="icon"><img src="assets/img/arcticons_fast-shopping.png"></div>
            <div>
                <p>Buying a new house now feels like shopping for new clothes online.</p>
            </div>
        </div>
    </div>

    <!-- section1 -->
    <div class="section1">
        <div class="img">
            <img src="assets/img/Group 432 (3).png" alt="" srcset="">
        </div>
        <div class="text">
            <p>“ If you don't own a home, buy one. If you own a home, buy another one. If you own two homes buy a third. And lend your relatives the money to buy a home.”</p>
        </div>
    </div>

    <!-- listing section begins -->

    <div class="listing">
        <h3>Recent Houses</h3>
        <div class="listed-houses">
            <?php
            $result = $db->setQuery("SELECT * FROM items ORDER BY id DESC LIMIT 8;");
            $numrows = mysqli_num_rows($result);

            if ($numrows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $images = json_decode($row['images']);
            ?>
                    <a href="product?i=<?php echo $row['item_id']; ?>">
                        <div class="body">
                            <div class="img">
                                <img src="item-images/<?php echo $images[0]; ?>" alt="" data-aos="zoom-in" data-aos-duration="1000" class="hover-animation">
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

        <!-- see more -->
        <!-- <p><a href="featured-product">See More<i class="fa fa-angle-double-right"></i></a></p> -->

    </div>








    <!-- listing section ends -->

    <!-- become an agent tag -->
    <div class="become-an-agent">
        <p>Got houses for rent, lease or sale?</p>

        <div class="button">
            <a href="agent-sign-up">Become An Agent</a>

        </div>

    </div>

    <!-- sub section 2 -->
    <div class="section2" data-aos="fade-up" data-aos-duration="1000">
        <div class="text">
            <p>“ Home is the starting place of love, hope and dreams. The magic thing about home is that it feels good to leave, and it feels even better to come back.”</p>
        </div>
        <div class="img">
            <img src="assets/img/Group 432 (1).png" alt="" srcset="" data-aos="flip-up" data-aos-duration="1000">
        </div>
    </div>


    <!-- loctions -->
    <div class="location">
        <p>Featured Locations</p>
        <div class="locations">
            <a href="product-listing?location=Rumoula" class="img">
                <p>Rumoula</p>
                <img src="assets/img/Group 3.png" alt="" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
            </a>
            <a href="product-listing?location=Old GRA" class="img">
                <p>Old GRA</p>
                <img src="assets/img/Group 452.png" alt="" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
            </a>
            <a href="product-listing?location=Port-Harcourt Township" class="img">
                <img src="assets/img/image 4 (2).png" alt="" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                <div class="img-text">
                    <p>Port-Harcourt <br />Township</p>
                </div>
            </a>
            <a href="product-listing?location=Eneka" class="img">
                <p>Eneka</p>
                <img src="assets/img/Group 453.png" alt="" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
            </a>
        </div>
    </div>

    <!-- newsletter -->
    <form action="" method="get">
        <div class="subscribe">
            <input type="email" name="newsletter" id="newsletter" placeholder="Enter your email to subscribe to our newletter">

            <div class="button2">
                <a href="#"><button>Subscribe</button></a>
            </div>

        </div>
    </form>






    <!-- footer-section  starts-->
    <?php include 'footer.php'; ?>






    <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.js"></script>
    <script defer src="assets/js/main.js"></script>

</body>

</html>