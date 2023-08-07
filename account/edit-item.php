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


if (!isset($_GET['item_id'])) {
    $admin->goTo("my-listings", "invalid_item");
}

$item_id = mysqli_real_escape_string($db->conn, $_GET['item_id']);
if (!$item->itemIdExists($item_id)) {
    $admin->goTo("my-listings", "invalid_item");
}

if (isset($_GET['submit'])) {
    $category = mysqli_real_escape_string($db->conn, $_GET['category']);
    $item_type = mysqli_real_escape_string($db->conn, $_GET['item_type']);
    $title = mysqli_real_escape_string($db->conn, $_GET['title']);
    $location = mysqli_real_escape_string($db->conn, $_GET['location']);
    $item_condition = mysqli_real_escape_string($db->conn, $_GET['item_condition']);
    $nearest_bustop = mysqli_real_escape_string($db->conn, $_GET['nearest_bustop']);
    $number_of_rooms = mysqli_real_escape_string($db->conn, $_GET['number_of_rooms']);
    if (isset($_GET['amenities'])) {
        $amenities = mysqli_real_escape_string($db->conn, json_encode($_GET['amenities']));
    } else {
        $amenities = "[]";
    }
    $number_of_toilets = mysqli_real_escape_string($db->conn, $_GET['number_of_toilets']);
    $price = mysqli_real_escape_string($db->conn, $_GET['price']);
    $number_of_bathrooms = mysqli_real_escape_string($db->conn, $_GET['number_of_bathrooms']);
    $additional_information = mysqli_real_escape_string($db->conn, $_GET['additional_information']);
    $images = mysqli_real_escape_string($db->conn, $_GET['images']);

    if ($additional_information == "") {
        $additional_information = "Empty";
    }

    $item->setDetail($item_id, "category", $category);
    $item->setDetail($item_id, "item_type", $item_type);
    $item->setDetail($item_id, "title", $title);
    $item->setDetail($item_id, "location", $location);
    $item->setDetail($item_id, "item_condition", $item_condition);
    $item->setDetail($item_id, "nearest_bustop", $nearest_bustop);
    $item->setDetail($item_id, "number_of_rooms", $number_of_rooms);
    $item->setDetail($item_id, "amenities", $amenities);
    $item->setDetail($item_id, "number_of_toilets", $number_of_toilets);
    $item->setDetail($item_id, "price", $price);
    $item->setDetail($item_id, "number_of_bathrooms", $number_of_bathrooms);
    $item->setDetail($item_id, "additional_information", $additional_information);
    $item->setDetail($item_id, "images", $images);


    $admin->goTo("edit-item-success", "item_id=$item_id");
}

$result = $db->setQuery("SELECT * FROM items WHERE item_id='$item_id';");
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List a house</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/list-a-house.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- <link rel="stylesheet" href="../assets/css/example-styles.css"> -->

</head>

<body>
    <!-- navbar starts -->

    <div class="navbar">
        <div class="logo">
            <a href="../"><img src="../assets/img/logo.png" alt="logo-img"></a>
        </div>

        <div class="navlinks" id="navlinks">
            <ul>

                <a href="../product">
                    <li>Rent</li>
                </a>
                <a href="../product">
                    <li>Buy</li>
                </a>
                <li id="none"><a href="logout"><i class="fa-regular fa-user" style="color: #fff;"></i>Logout?</a>

                </li>
                <a href="../faq">
                    <li><i class="fa-regular fa-circle-question"></i>Help</li>
                </a>

            </ul>
        </div>

        <div class="account-icon"><a href="sign-in"><i class="fa-regular fa-user fa-lg" style="color: #fff;"></i></a></div>
        <div class="hamburgeropen" id="hamburgeropen"><i class="fa-solid fa-bars fa-lg" style="color: #fff;"></i></div>

        <div class="navdropdown" id="navdropdown">
            <div class="hamburgerclose" id="hamburgerclose"><i class="fa-solid fa-xmark fa-xl" style="color: #fff;"></i></div>
            <ul>
                <a href="list-a-house">
                    <li>List a House</li>
                </a>
                <a href="../product">
                    <li>Rent</li>
                </a>
                <a href="../product">
                    <li>Buy</li>
                </a>
                <a href="../faq">
                    <li>Help</li>
                </a>
            </ul>

            <div class="nav2"></div>
        </div>


    </div>


    <!-- navbar ends -->


    <div class="list-a-house">
        <div class="header">
            <h2>Edit</h2>
            <?php
            // if (isset($_GET['amenities'])) {
            //     print_r($_GET['amenities']);
            // }
            ?>

        </div>

        <form action="" method="GET" id="formm" onsubmit="return validateForm()">
            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
            <div id="first-section">
                <div class="step-one">
                    <div class="heading">
                        <p>Step 1: Select Category</p>
                    </div>
                    <div class="dropdown-input">
                        <div class="dropdown">
                            <p>Category</p>
                            <select name="category" class="form-select" required>

                                <option><?php echo $row['category']; ?></option>
                                <option value="">Select an Option</option>
                                <option>Buy</option>
                                <option>Rent</option>
                                <option>Lease</option>
                            </select>
                        </div>

                        <div class="dropdown">
                            <p>Type of House</p>
                            <select name="item_type" class="form-select" required>
                                <option><?php echo $row['item_type']; ?></option>
                                <option value="">Select an Option</option>
                                <option>Flat</option>
                                <option>Boys Quarter</option>
                                <option>Studio Apartment</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="step-two">
                    <div class="heading">
                        <p>Step 2: House Details</p>
                    </div>
                    <div class="dropdown-input">
                        <div class="dropdown">
                            <p>Title</p>
                            <input name="title" value="<?php echo $row['title']; ?>" type="text" placeholder="Add a caption for your listing" required>
                        </div>
                        <div class="dropdown">
                            <p>Location</p>
                            <input name="location" value="<?php echo $row['location']; ?>" type="text" placeholder="Location of the house" required>
                        </div>
                    </div>


                    <div class="dropdown-input">
                        <div class="dropdown">
                            <p>Condition</p>
                            <select name="item_condition" class="form-select" required>

                                <option><?php echo $row['item_condition']; ?></option>
                                <option value="">Select an Option</option>
                                <option>Furnunised</option>
                                <option>Unfurnished</option>
                            </select>
                        </div>
                        <div class="dropdown">
                            <p>Nearest Bustop</p>
                            <input name="nearest_bustop" value="<?php echo $row['nearest_bustop']; ?>" type="text" placeholder="Nearest Bustop/Landmark to house" required>
                        </div>
                    </div>




                    <div class="dropdown-input">

                        <div class="dropdown">
                            <p>Number of Rooms</p>
                            <select name="number_of_rooms" class="form-select" required>
                                <option><?php echo $row['number_of_rooms']; ?></option>
                                <option value="">Select an Option</option>
                                <!-- <option>Single Room</option>
                                <option>1 Bedroom</option>
                                <option>2 Bedrooms</option>
                                <option>3 Bedrooms</option>
                                <option>4 Bedrooms and above</option> -->
                                <?php
                                for ($i = 1; $i < 200; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="dropdown amenities">
                            <p>Amenities</p>
                            <div class="multiselect">
                                <div class="selectBox" onclick="showCheckboxes()">
                                    <select>
                                        <option>Select an Option</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxes">

                                    <?php
                                    $item_amenities = json_decode($row['amenities']);
                                    $amenities = array(
                                        array("id" => "one", "name" => "Good access road"),
                                        array("id" => "two", "name" => "Security"),
                                        array("id" => "three", "name" => "Light"),
                                        array("id" => "four", "name" => "Swimming Pool"),
                                    );

                                    foreach ($amenities as $amenity) {

                                    ?>
                                        <label for="<?php echo $amenity['id'] ?>">
                                            <input name="amenities[]" value="<?php echo $amenity['name'] ?>" type="checkbox" id="<?php echo $amenity['id'] ?>" <?php if (in_array($amenity['name'], $item_amenities)) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?> /><?php echo $amenity['name']; ?>
                                        </label>
                                    <?php
                                    }
                                    ?>
                                    <!-- <label for="two">
                                        <input name="amenities[]" value="Security" type="checkbox" id="two" />Security
                                    </label>
                                    <label for="three">
                                        <input name="amenities[]" value="Light" type="checkbox" id="three" />Light
                                    </label> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-input">

                        <div class="dropdown">
                            <p>Number of Toilets</p>
                            <select name="number_of_toilets" class="form-select" required>

                                <option><?php echo $row['number_of_toilets']; ?></option>
                                <option value="">Select an Option</option>
                                <!-- <option>1 Toilet</option>
                                <option>2 Toilets</option>
                                <option>3 Toilets</option>
                                <option>4 Toilets and above</option> -->
                                <?php
                                for ($i = 1; $i < 200; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="dropdown">

                            <p>Price</p>
                            <!-- <div class="price">
                                <span>&#8358</span>
                                <input type="text">
                            </div> -->
                            <div class="input-group mb-3 price">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">&#8358</span>
                                </div>
                                <input name="price" value="<?php echo $row['price']; ?>" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                    </div>




                    <div class="dropdown-input">

                        <div class="dropdown">
                            <p>Number of Bathrooms</p>
                            <select name="number_of_bathrooms" class="form-select" required>
                                <option><?php echo $row['number_of_bathrooms']; ?></option>
                                <option value="">Select an Option</option>
                                <!-- <option>1 Bathrooms</option>
                                <option>2 Bathrooms</option>
                                <option>3 Bathrooms</option>
                                <option>4 Bathrooms and above</option> -->
                                <?php
                                for ($i = 1; $i < 200; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="dropdown">
                            <p>Additional Information</p>

                            <textarea name="additional_information" id="" cols="50" rows="6" placeholder="Add any additional information you will want  people to see.  Add as much details of your house as posible"><?php echo $row['additional_information']; ?></textarea>

                        </div>
                    </div>




                    <!-- <div class="buttons" style="margin-top: 100px;">
                        <a id="reset">Cancel</a>
                        <a id="next-page">Next Page</a>
                    </div> -->

                </div>
            </div>

            <!-- new section -->
            <div class="list-a-house" id="next-section" style="display:block">
                <div class="step-one">
                    <div class="heading">
                        <p>Step 3: Add Pictures</p>
                    </div>

                    <div class="picture-upload">
                        <p>Add at least 4 photos for this category, the first picture will be the title picture. </p>

                        <span class="button" id="upload-btn">+</span class=".button">
                        <p>Each picture must not exceed 5 Mb</p>
                        <p>Supported formats are *.jpg and *.png</p>

                        <!-- <input type="file" multiple onchange="previewMultiple(event)" id="additionalfoto" style="display: none;"> -->

                        <input type="file" id="input" accept="images/png images/jpeg images/jpg" style="display: none;">
                        <div id="preview">
                            <?php
                            $images = json_decode($row['images']);
                            foreach ($images as $image) {
                                $img = explode(".", $image);
                                $image_id = $img[0];
                                $image_ext = $img[1];
                            ?>
                                <div class="preview-box preview-box<?php echo $image_id; ?>">
                                    <span class="delete-btn" onclick="deleteImage(this)" image_id="<?php echo $image_id; ?>" image_ext="<?php echo $image_ext; ?>">x</span>
                                    <img src="../item-images/<?php echo $image; ?>" alt="">
                                </div>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                    <input type="hidden" value='<?php echo $row['images']; ?>' name="images" class="images">
                    <div class="buttons" style="margin-top:-30px;">
                        <!-- <a id="previous-page">Previous</a> -->
                        <button id="finish-listing" name="submit">Finish</button>
                    </div>
                </div>

            </div>

        </form>



        <div class="listing-confirmation" id="listing-confirmation">
            <div class="listing-confirmation-box">
                <div class="img">
                    <img src="../assets/img/undraw_happy_announcement_re_tsm0 1.png" alt="">
                </div>
                <p>Your House has been listed successfully </p>

                <a href="dashboard">Go to My Account</a>
            </div>
        </div>


    </div>

    </div>


    <script defer src="../assets/js/all.min.js"></script>
    <script defer src="../assets/js/fontawesome.min.js"></script>
    <script src="../assets/js/list-a-house.js"></script>
    <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js”></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script defer src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/jquery.multi-select.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#people').multiSelect();
        });



        var images = JSON.parse('<?php echo $row['images']; ?>');
        const uploadBtn = document.getElementById("upload-btn");
        const input = document.getElementById("input");
        const preview = document.getElementById("preview");


        // to make the button trigger the input file
        uploadBtn.addEventListener("click", (e) => {
            document.querySelector('#input').click();
        });


        input.addEventListener("change", () => {
            const files = input.files;
            const file = files[0];



            var data = new FormData();
            data.append('file', file);

            var imgname = input.value;
            var size = input.files[0].size;

            var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
                if (size <= 1000000) {
                    $.ajax({
                        url: "ajax-upload-item-image.php",
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // tell jQuery not to process the data
                        contentType: false // tell jQuery not to set contentType
                    }).success(function(data) {
                        var data = JSON.parse(data)

                        if (data.status == "FILE_SIZE_ERROR") {
                            alert("File size too big!");
                        } else if (data.status == "FILE_TYPE_ERROR") {
                            alert(`Invalid file type. Kindly upload: 'jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPEG' OR 'JPG'`);
                        } else if (data.status == "success") {
                            var src = data.id + "." + data.ext;
                            var preview_box = document.createElement("div");
                            preview_box.classList.add("preview-box")
                            preview_box.classList.add(`preview-box${data.id}`)

                            // const src = URL.createObjectURL(file);
                            images.push(src)

                            var img = document.createElement("img");
                            img.src = `../item-images/` + src;

                            var delete_btn = document.createElement("span");
                            delete_btn.classList.add("delete-btn");
                            delete_btn.innerHTML = "x";
                            delete_btn.setAttribute("onclick", "deleteImage(this)")
                            delete_btn.setAttribute("image_id", data.id)
                            delete_btn.setAttribute("image_ext", data.ext)

                            preview_box.appendChild(img)
                            preview_box.appendChild(delete_btn);

                            preview.appendChild(preview_box);

                            addToImagesField(images)
                        }
                    })
                }
            }




        });


        function deleteImage(e) {
            var image_id = e.getAttribute("image_id");
            var image_ext = e.getAttribute("image_ext");
            var image = image_id + "." + image_ext;

            for (var i = 0; i < images.length; i++) {
                if (images[i] == image) {
                    images.splice(i, 1);
                    $(`.preview-box${image_id}`).css("display", "none");
                }
            }
            addToImagesField(images);

        }

        function addToImagesField(images) {
            let imgs = "";
            if (images.length > 0) {
                imgs = JSON.stringify(images);
            }
            $(".images").val(imgs)
        }


        function validateForm() {
            if ($(".images").val() == "") {
                alert("You must add at least one image!")
                return false;
            } else {
                return true;
            }
        }
    </script>

</body>

</html>