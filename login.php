<?php
include_once 'header.php';
?>
    <section class="signup-form" >
        <h2>Login</h2>
        <div class="signup-form-form" >
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username/Email">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyinput') {
                echo "<p>All Fields Are Required</p>";
            }
            else if ($_GET['error'] == 'wornglogin') {
                echo "<p>Email Or Password Incorrect</p>";
            }
        }
        ?>
    </section>
<?php
include_once 'footer.php'; ?>