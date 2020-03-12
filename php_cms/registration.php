<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php session_start(); ?>

<?php
if(isset($_POST['submit'])){
    $new_username = $_POST['username'];
    $new_user_email = $_POST['email'];
    $new_user_password = $_POST['password'];

    if(!empty($new_username) && !empty($new_user_email) && !empty($new_user_password)){
        $new_username = mysqli_real_escape_string($connection, $new_username);
        $new_user_email = mysqli_real_escape_string($connection, $new_user_email);
        $new_user_password = mysqli_real_escape_string($connection, $new_user_password);

        // password encryption
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $new_user_password = crypt($new_user_password, $salt);

        if (!$select_randsalt_query) {
            die("Query Failed " . mysqli_error($connection));
        }

        $row = mysqli_fetch_array($select_randsalt_query);

        $query = "INSERT INTO users (user_username, user_email, user_password, user_role) VALUES ('{$new_username}', '{$new_user_email}', '{$new_user_password}', 'subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die("Query Failed " . mysqli_error($connection));
        }
        $_SESSION['username'] = $new_username;
        $_SESSION['user_role'] = "subscriber";
        header("location: admin");

    } else {
        $message = "Fields cannot be empty";
    }
} else {
    $message = "";
}
?>


    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <h5 class="text-center"><?php $message ?></h5>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" required>
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
