<div class="footer">
    <div class="top">
        <div class="logo-img"><img src="assets/img/logo.png" alt="this is a logo"></div>
        <div class="footer-links">
            <div class="footer-link">
                <div>
                    <p><a href="faq">About Us</a></p>
                    <p><a href="faq">FAQ</a></p>
                    <p><a href="faq">Help</a></p>


                </div>
            </div>
            <div class="footer-link">
                <div>
                    <p><a href="sign-in?redirect=list-a-house">List</a></p>
                    <?php
                    $categories = $admin->getCategories();
                    $x = 0;
                    foreach ($categories as $category) {
                        if ($x < 3) {
                            echo "<p><a href='product?category[]=$category'>$category</a></p>";
                        }
                        $x++;
                    }
                    ?>
                    <!-- <p><a href="product?category[]=Rent">Rent</a></p>
                    <p><a href="product?category[]=Rent">Buy</a></p>
                    <p><a href="product?category[]=Lease">Lease</a></p> -->
                </div>
            </div>
            <div class="footer-link">
                <div>
                    <p><a href="https://www.facebook.com/homigon.ng/">homigon <img src="assets/img/Facebook - Original.png"></a></p>
                    <p><a href="https://www.instagram.com/invites/contact/?i=at5zmf0d0jcl&utm_content=oex2ikq">homigon <img src="assets/img/Instagram - Original.png"></a></p>
                    <p><a href="https://twitter.com/Homigon_ng?t=ATHmXqPdqIPtTdCOAwY9sA&s=09">homigon_ng <img src="assets/img/Twitter - Original.png"></a></p>

                </div>
            </div>
        </div>

    </div>



    <!-- <div class="logo-img-2"><img src="assets/img/logo.png" alt="this is a logo"></div> -->
    <div class="bottom">
        <p><img src="assets/img/charm_copyright.png">Copyright 2023. All rights Reserved. Homigon</p>
    </div>



</div>