<?php include "includes/admin_header.php";?>
<?php $_SESSION['sidenav'] = "Profile";?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE user_username = '{$username}'";
    $select_user_profile_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}
?>
<?php edit_user(); ?>
<body>
    <div id="wrapper">
        <?php include "includes/admin_navigation.php"?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <div class="container">
                            <div class="text-center center-block" style="max-width:250px; max-height:200px; overflow:hidden;">
                                <img class="img-fluid" width="250" src="../images/<?php 
                                if (!isset($_SESSION['user_image'])) {
                                    echo $user_profile_image;
                                } else {
                                    echo $user_image;
                                }
                                ?>" style="min-height:200px; object-fit:cover; object-position:50% -40px;">
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="user_pfp">Profile Picture:</label>
                                    <input type="file" name="user_pfp" id="user_pfp" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="user_username">Username:</label>
                                    <input value="<?php echo $user_username; ?>" class="form-control" type="text" name="user_username" id="user_username">
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Password:</label>
                                    <input value="<?php echo $user_password; ?>" class="form-control" type="password" name="user_password" id="user_password">
                                </div>
                                <div class="form-group">
                                    <label for="user_first_name">First Name:</label>
                                    <input value="<?php echo $user_first_name; ?>" class="form-control" type="text" name="user_first_name" id="user_first_name">
                                </div>
                                <div class="form-group">
                                    <label for="user_last_name">Last Name:</label>
                                    <input value="<?php echo $user_last_name; ?>" class="form-control" type="text" name="user_last_name" id="user_last_name">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email:</label>
                                    <input value="<?php echo $user_email; ?>" class="form-control" type="email" name="user_email" id="user_email">
                                </div>
                                <div class="form-group">
                                    <label for="user_role">User Role:</label>
                                    <br>
                                    <select class="custom-select" name="user_role" id="user_role">
                                        <option value="<?php echo $user_role ?>"><?php echo $user_role; ?></option>
                                        <?php
                                        if ($user_role == "admin") {
                                            echo "<option value='subscriber'>subscriber</option>";
                                        } else {
                                            echo "<option value='admin'>admin</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="custom-file">
                                        <label for="post_image">Post Image</label>
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image" accept="image/*">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <input class="btn btn-primary" name="edit_user" type="submit" value="Update Profile">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"?>