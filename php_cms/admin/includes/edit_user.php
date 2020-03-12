<?php
if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);

    // Find all posts query
    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);

    if (!$select_randsalt_query) {
        die("Query Failed " . mysqli_error($connection));
    }

    $query = "UPDATE users SET ";
    $query .= "user_username = '{$user_username}', ";
    $query .= "user_password = '{$hashed_password}', ";
    $query .= "user_first_name = '{$user_first_name}', ";
    $query .= "user_last_name = '{$user_last_name}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = '{$the_user_id}' ";

    $update_user = mysqli_query($connection, $query);

    confirm_query($update_user);
}
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_username">Username:</label>
            <input value="<?php echo $user_username ?>" class="form-control" type="text" name="user_username" id="user_username">
        </div>
        <div class="form-group">
            <label for="user_password">Password:</label>
            <input value="<?php echo $user_password ?>" class="form-control" type="password" name="user_password" id="user_password">
        </div>
        <div class="form-group">
            <label for="user_first_name">First Name:</label>
            <input value="<?php echo $user_first_name ?>" class="form-control" type="text" name="user_first_name" id="user_first_name">
        </div>
        <div class="form-group">
            <label for="user_last_name">Last Name:</label>
            <input value="<?php echo $user_last_name ?>" class="form-control" type="text" name="user_last_name" id="user_last_name">
        </div>
        <div class="form-group">
            <label for="user_email">Email:</label>
            <input value="<?php echo $user_email ?>" class="form-control" type="email" name="user_email" id="user_email">
        </div>
        <div class="form-group">
            <label for="user_role">User Role:</label>
            <br>
            <select class="custom-select" name="user_role" id="user_role">
                <option value="subscriber"><?php echo $user_role ?></option>
                <?php 
                    if ($user_role == "admin"){
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
            <input class="btn btn-primary" name="edit_user" type="submit" value="Update User">
        </div>
    </form>
</div>
