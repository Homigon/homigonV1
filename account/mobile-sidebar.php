  <div class="bar" id="dash">
      <a href="./" style="color:#ffffff ;">
          <div class="menu">
              <img src="../images/7148740_category_variety_random_shuffle_icon 1.png" alt="">
              <p>Dashboard</p>
          </div>
      </a>

      <a href="profile" style="color:black ;">
          <div class="menu">
              <img src="../images/Vector.png" alt="">
              <p>My Profile</p>
          </div>
      </a>
      <!-- 
      <a href="message" style="color:#ffffff ;">
          <div class="menu">
              <img src="../images/Vector (11).png" alt="">
              <p>My Messages</p>
          </div>
      </a> -->

      <?php
        if ($user->isAgent($session_id)) {
        ?>
          <a href="my-listings" style="color:#ffffff ;">
              <div class="menu">
                  <img src="../images/bx_building-house.png" alt="">
                  <p>My Listings</p>
              </div>
          </a>
      <?php
        }
        ?>

      <a href="saved-items" style="color:#ffffff ;">
          <div class="menu">
              <img src="../images/Vector (8).png" alt="">
              <p>Saved Houses</p>
          </div>
      </a>

      <!-- <a href="upgrade" style="color:#ffffff ;">
          <div class="menu">
              <img src="../images/Vector (9).png" alt="">
              <p>Upgrades</p>
          </div>
      </a> -->
  </div>