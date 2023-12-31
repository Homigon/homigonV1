<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQs</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
  <div class="navbar">
    <div class="logo">
      <a href="./"><img src="assets/img/logo.png" alt="logo-img"></a>
    </div>

    <div class="navlinks" id="navlinks">
      <ul>
        <a href="list-a-house">
          <li>List a House</li>
        </a>
        <a href="product">
          <li>Rent</li>
        </a>
        <a href="product">
          <li>Buy</li>
        </a>
        <li id="none"><a href="./"><i class="fa-regular fa-user" style="color: #fff;"></i>Account</a>
          <ul>
            <a href="sign-in">
              <li>Sign-In</li>
            </a>
            <a href="create-account">
              <li>Sign-Up</li>
            </a>
          </ul>
        </li>
        <a href="faq">
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
        <a href="product">
          <li>Rent</li>
        </a>
        <a href="product">
          <li>Buy</li>
        </a>
        <a href="faq">
          <li>Help</li>
        </a>
      </ul>


    </div>


  </div>



  <!-- navbar ends -->



  <div class="about-section">
    <div class="header">
      <h3>About us/Help/FAQs</h3>
    </div>

    <div class="about-us">
      <h3>About us</h3>
      <p>Homigon is a real estate website looking to help people find houses to rent and also allow landlords and property agents adverties their available houses. We offer house hunters an easy way to find houses with house listings for sale, rent and lease.</p>
    </div>

    <div class="help">
      <h3>Help</h3>
      <p>Our support team is always ready to provide all the necessary assistance.</p>
      <p>Fill the form below to send in your complains, suggestions and questions</p>
      <form>
        <div class="name-contact">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Fill in your name" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Contact</label>
            <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="Email Address / Phone number " required>
          </div>
        </div>


        <div class="form-group">
          <label for="exampleFormControlTextarea1">Feedback</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Fill in your complains, suggestions and questions"></textarea>
        </div>
        <input type="submit" value="Submit">
      </form>
    </div>


    <p style="margin: 50px 70px; text-align:center;">In the meantime you can check out our <span style="color: #ffc700;">frequently asked questions</span></p>


    <!-- faqs -->
    <div class="faqs">
      <h3 style="color: #333;">FAQs</h3>
      <div class="accordion" id="accordionExample">

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Who is an agent?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>Agents is a property owner or property agent.</p>
              <p>A agent can list houses for rent, lease or sale</p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              How do I become an agent?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>You can be come agent by signing up as an agent or switching your account to an agent account </p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              How do I become an agent?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>You can be come agent by signing up as an agent or switching your account to an agent account </p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              How do I upload our listings?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>You can upload your listing by signing up as an agent and adding your property via the “list a house” tab on the website.</p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              What are account upgrades ?

            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>Upgrades help agents to be able to list more houses and promote them on the webiste</p>
              <p>a result, you will get more visibility for your listing</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              Is there a limit to the number of photographs I can upload?
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>Agent basic accounts can post a maximum of 4 pictures per ad</p>
              <p>Agent pro accounts can post a maximum of 7 pictures per ad</p>
              <p>Agent ultra accounts can post an unlimited number of pictures per ad </p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingSeven">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              How long will my listing stay ?
            </button>
          </h2>
          <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>Your listings remain on the site for 1-3 months before they are automatically deleted or until you decide to deactivate them.</p>
              <p>You can always update your listing if it is still avaibile.</p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingEight">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
              Is there any limit to the number of properties I can list?
            </button>
          </h2>
          <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>Agent basic accounts can only list 3 houses at a time.</p>
              <p>Agent pro accounts can only list 10 houses at a time.</p>
              <p>Agent ultra accounts can post an unlimited number of houses.</p>
              <p>Individual users can only post an ad with a maximum of 3 pictures but the user will have to pay a verification fee for the ad.</p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>






  <!-- footer-section  starts-->
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
            <p><a href="product">Rent</a></p>
            <p><a href="list-a-house">List</a></p>
            <p><a href="product">Buy</a></p>
            <p><a href="product">Lease</a></p>
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
      <p><img src="assets/img/charm_copyright.png">Copyright 2022. All rights Reserved. Homigon</p>
    </div>



  </div>






  <script defer src="assets/js/all.min.js"></script>
  <script defer src="assets/js/fontawesome.min.js"></script>
  <script defer src="assets/js/bootstrap.min.js"></script>
  <script defer src="assets/js/main.js"></script>

</body>

</html>