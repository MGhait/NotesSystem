<?php
include_once 'header.php';
?>
    <section class="signup-form" >
      <h2>Sing up</h2>
      <div class="signup-form-form" >
          <form action="includes/signup.inc.php" method="post">
              <input type="text" name="name" placeholder="Full Name ">
              <input type="text" name="email" placeholder="Email ">
              <input type="text" name="uid" placeholder="Username ">
              <input type="password" name="pwd" placeholder="Password ">
              <input type="password" name="pwdRepeat" placeholder="Password Repeat ">
              <button type="submit" name="submit">Sign Up</button>
          </form>
      </div>
        <!-- error handling  -->
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyinput') {
                echo "<p>All Fields Are Required</p>";
            }
            else if ($_GET['error'] == 'invaliduid') {
                echo "<p>Use A Valid UserName</p>";
            }
            else if ($_GET['error'] == 'invalidemail') {
                echo "<p>Email Is Invalid, Use Valid One</p>";
            }
            else if ($_GET['error'] == 'pwdnotmatch') {
                echo "<p>Password Don't Match!</p>";
            }
            else if ($_GET['error'] == 'usernametaken') {
                echo "<p>Account Already Exists!</p>";
            }
            else if ($_GET['error'] == 'stmtfaild') {
                echo "<p>Something Went Wrong, Try again Later</p>";
            }
            else if ($_GET['error'] == 'none') {
                echo "<p>You Have Signed up Successfully !</p>";
            }
        }
    ?>
    </section>

<?php
include_once 'footer.php'; ?>