<?php add_new_user(); ?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_username">Username:</label>
            <input class="form-control" type="text" name="user_username" id="user_username">
        </div>
        <div class="form-group">
            <label for="user_password">Password:</label>
            <input class="form-control" type="password" name="user_password" id="user_password">
        </div>
        <div class="form-group">
            <label for="user_first_name">First Name:</label>
            <input class="form-control" type="text" name="user_first_name" id="user_first_name">
        </div>
        <div class="form-group">
            <label for="user_last_name">Last Name:</label>
            <input class="form-control" type="text" name="user_last_name" id="user_last_name">
        </div>
        <div class="form-group">
            <label for="user_email">Email:</label>
            <input class="form-control" type="email" name="user_email" id="user_email">
        </div>
        <div class="form-group">
            <label for="user_role">User Role:</label>
            <br>
            <select class="custom-select" name="user_role" id="user_role">
                <option value="subscriber">Select Options</option>
                <option value="admin">admin</option>
                <option value="subscriber">subscriber</option>
            </select>
        </div>
        <!-- <div class="form-group">
            <div class="custom-file">
                <label for="post_image">Post Image</label>
                <input type="file" class="custom-file-input" id="post_image" name="post_image" accept="image/*">
            </div>
        </div> -->
        <div class="form-group">
            <input class="btn btn-primary" name="add_user" type="submit" value="Add New User">
        </div>
    </form>
</div>