<?php
session_start();

include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';
include '../classes/items.class.php';

if (!isset($_SESSION['user_id'])) {
    $admin->goTo("../sign-in", "invalid_user");
}

$session_id = $_SESSION['user_id'];


if (isset($_GET['delete_item'])) {
    $item_id = mysqli_real_escape_string($db->conn, $_GET['item_id']);

    $db->setQuery("DELETE FROM items WHERE item_id='$item_id';");
    // $db->setQuery("DELETE FROM saved_items WHERE item_id='$item_id';");

    $admin->goTo("my-listings", "listing_deleted");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/account.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="../assets/css/media.css?v=<?php echo uniqid(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>HOMIGON</title>
</head>

<body>
    <section class="account">
        <div class="content" id="con">
            <?php include 'header.php'; ?>


        </div>

        <div class="black" id="blur">

        </div>

        <div class="dashboards">
            <img src="../images/Vector (23).png" alt="" id="dashb">
            <img src="../images/Vector (24).png" alt="" id="dashc">
        </div>

        <div class="profile">
            <?php include 'mobile-sidebar.php'; ?>




            <div class="houses">


                <div class="top">
                    <h2>My Listings</h2>
                    <p>Add, edit and delete your listing</p>
                    <?php
                    if (isset($_GET['listing_deleted'])) {
                        echo "<div style='width:80%;padding:10px;border-radius:8px;background:orange;color:white;margin:auto;margin-bottom:10px;'>Listing successfully deleted!</div>";
                    }
                    ?>
                </div>

                <div style="display:flex;flex-flow:row wrap;gap:10%;">
                    <?php
                    $result = $db->setQuery("SELECT * FROM items WHERE user_id='$session_id';");
                    $numrows = mysqli_num_rows($result);

                    if ($numrows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $images = json_decode($row['images']);
                    ?>

                            <div class="listing">

                                <div class="image">

                                    <h4><?php echo $row['title']; ?></h4>
                                    <div class="cnt">
                                        <div class="left">

                                            <a href="../product?i=<?php echo $row['item_id']; ?>"><img src="../item-images/<?php echo $images[0]; ?>" alt=""></a>

                                        </div>
                                        <div class="right">
                                            <h4><span>&#8358</span><?php echo number_format($row['price']); ?></h4>
                                            <div class="fst">
                                                <a href="./"><img src="../images/Vector2.png" alt=""></a>
                                                <p> <?php echo $row['location']; ?> </p>
                                            </div>
                                            <div class="frst">
                                                <div class="icon">
                                                    <a href="./"><img src="../images/Group 191.png" alt=""></a>
                                                    <p> <?php echo $row['number_of_rooms']; ?></p>
                                                </div>
                                                <div class="icon">
                                                    <a href="./"><img src="../images/Group 192.png" alt=""></a>
                                                    <p> <?php echo $row['number_of_bathrooms']; ?> </p>
                                                </div>
                                                <div class="icon">
                                                    <a href="./"><img src="../images/Group 190.png" alt=""></a>
                                                    <p> <?php echo $row['number_of_toilets']; ?> </p>
                                                </div>
                                            </div>
                                            <div class="fst" style="margin-top:-1.5rem ;">
                                                <a href="./"><img src="../images/Vector3.png" alt=""></a>
                                                <p> Posted <?php echo $db->format_time($row['time'])['time'] . " " . $db->format_time($row['time'])['time_frame']
                                                            ?> ago </p>
                                            </div>
                                            <div style="margin-top:15px;display:flex;gap:5px;">
                                                <a href="edit-item?item_id=<?php echo $row['item_id'] ?>" style="padding:10px 20px;border-radius:8px;background:royalblue;color:white;font-size:14px;cursor:pointer;">Edit</a>
                                                <a onclick="deleteItem(this)" item_id="<?php echo $row['item_id'] ?>" style="padding:10px 20px;border-radius:8px;background:crimson;color:white;font-size:14px;cursor:pointer;">Delete</a>
                                            </div>

                                        </div>

                                    </div>


                                </div>


                                <!-- <div class="saves">
                                <div class="cont">
                                    <div class="ten">
                                        <p>Total number of saves <span>10</span></p>
                                        <p>Total number of views <span>10</span></p>
                                        <p>Total number of contact view <span>10</span></p>

                                    </div>
                                    <a href="./">
                                        <div class="remove">
                                            <h3>Remove</h3>
                                            <img src="../images/Layer 17.png" alt="">
                                        </div>
                                    </a>

                                </div>

                            </div> -->

                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="img">
                            <p>You do not have any listed houses</p>
                            <img src="../images/undraw_feeling_blue_-4-b7q 1.png" alt="">
                            <div style="width:100%;display:flex;justify-content:center;margin-top:10px;">
                                <a href="list-a-house" style="padding:20px;width:70%;font-size:15px;background:#FFC700;color:white;border-radius:8px;">List a property</a>
                            </div>

                        </div>
                    <?php
                    }
                    ?>

                </div>



            </div>






            <!-- mobile view --


            <div class="houses" id="mobile">
                <div class="dashboards">
                    <img src="../images/Vector (23).png" alt="" id="dashb">
                    <img src="../images/Vector (24).png" alt="" id="dashc">
                </div>
                <div class="top">
                    <h2>My Listings</h2>
                    <p>Add, edit and delete your listing</p>
                </div>


                <div class="listing">

                    <div class="image">


                        <div class="cont">

                            <div class="first">

                                <a href="./"><img src="../images/Vector photo.png" alt=""></a>
                                <h3>4 bedroom block of flat in Port Harcourt for sale <br><br><br> <span>#xxx,xxx</span> </h3>


                            </div>
                            <div class="second">

                                <div class="save">
                                    <div class="cont">
                                        <div class="10">
                                            <p>Total number of saves <span>10</span></p>
                                            <p>Total number of views <span>10</span></p>
                                            <p>Total number of contact view <span>10</span></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <a href="./">
                        <div class="remve">
                            <img src="../images/Layer 17.png" alt="">
                        </div>
                    </a>



                </div>









            </div> -->




        </div>
    </section>


    <script src="../assets/js/account.js"></script>

    <script>
        function deleteItem(item) {
            var item_id = item.getAttribute("item_id")
            if (confirm(`Are you show you want to delete this listing?`)) {
                window.location.href = `my-listings?delete_item&item_id=${item_id}`;
            }
        }
    </script>
</body>

</html>