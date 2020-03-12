<?php
//***********************************//
// --- MYSQL CONNECTION FUNCTIONS ---
//***********************************//

function confirm_query($result) {
    global $connection;
    if (!$result) {
        die(strtoupper("query failed ") . mysqli_error($connection));
    }
}

//***********************************//
// ----- CATEGORIES FUNCTIONS ------
//***********************************//

function insert_categories() {
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        // checking that the title input is not empty
        if ($cat_title == "" || empty($cat_title)) {
            echo "<p class='text-danger'>This field should not be empty.</p>";
        } else {
            // Insert data into categories table
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die(strtoupper("query failed") . mysqli_error($connection));
            }
        }
    }
}


function find_all_categories() {
        global $select_categories;
        global $connection;

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        // Find all categories query
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td><td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
        }
}

function update_categories() {
        global $connection;
        global $cat_update_id;

        // Update category query
        if (isset($_POST['edit_category'])) {
            $update_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = '$cat_update_id'";
            $update_edit_query = mysqli_query($connection, $query);

            if (!$update_edit_query) {
                die("Update failed" . mysqli_error($connection));
            }

            // Reload the page once deleted (ob_start() function required);
            header("location: categories.php");
        }
}

function delete_categories() {
        global $connection;

        // delete categories by id
        if (isset($_GET['delete'])) {
            $get_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
            $delete_query = mysqli_query($connection, $query);

            // Reload the page once deleted (ob_start() function required);
            header("location: categories.php");
        }
}

//***********************************//
// -------- POSTS FUNCTIONS ---------
//***********************************//

function add_new_post() {
        global $connection;

        if (isset($_POST['publish_post'])) {
            $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
            $post_author = $_POST['post_author'];
            $post_category = $_POST['post_category'];
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
            $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
            $post_date = date('d-m-y');

            // move uploaded file to images directory
            move_uploaded_file($post_image_temp, "../images/$post_image");

            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES('{$post_category}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

            $create_post_query = mysqli_query($connection, $query);

            confirm_query($create_post_query);

            $post_id = mysqli_insert_id($connection);

            echo "<p class='alert alert-success' role='alert'>Your Post Has Been Created—<a href='../post.php?p_id={$post_id}'>check it out!</a> or <a href='posts.php'>add more posts</a></p>";
        }
}

function edit_post () {
    global $connection;

    // setting all database properties to global
    global  $post_title,
            $post_content,
            $post_category_id,
            $post_author,
            $post_image,
            $post_status,
            $post_tags;

    if (isset($_GET['p_id'])) {
        $curr_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = '{$curr_post_id}'";
    $select_posts_by_id = mysqli_query($connection, $query);

    // Find all posts query and then display current values on form values
    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }

    // editing new changes made to the post
    if (isset($_POST['update_post'])) {
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
        $post_author = $_POST['post_author'];
        $post_category = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        // make sure image doesn't randomly dissapear
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $curr_post_id";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_category_id = '{$post_category}', ";
        $query .= "post_date = now(), ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}' ";
        $query .= "WHERE post_id = '{$curr_post_id}' ";

        $update_post = mysqli_query($connection, $query);

        confirm_query($update_post);

        echo "<p class='alert alert-success' role='alert'>Your Post Has Been Updated—<a href='../post.php?p_id={$curr_post_id}'>check it out!</a> or <a href='posts.php'>edit more posts</a></p>";
    }
}

function view_all_posts() {
    global $connection;

    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

    // Find all posts query
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td><input type='checkbox' name='checkBoxesArray[]' class='checkboxes' value='$post_id'></td>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        $update_query = mysqli_query($connection, $query);
        $select_categories_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>$cat_title</td>";
        }

        echo "<td>$post_status</td>";
        echo "<td class='text-center'><img width='120' src='../images/$post_image' alt='$post_title'></td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function delete_posts () {
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
        $delete_query = mysqli_query($connection, $query);

        header("location: posts.php");
    }
}

//***********************************//
// -------- USERS FUNCTIONS ---------
//***********************************//

function add_new_user () {
    global $connection;
    if (isset($_POST['add_user'])) {
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_username = $_POST['user_username'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];

        $user_password = mysqli_real_escape_string($connection, $user_password);

        // hashing user passwords for security
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        confirm_query($select_randsalt_query);

        $query = "INSERT INTO users(user_first_name, user_last_name, user_role, user_username, user_email, user_password) VALUES('{$user_first_name}','{$user_last_name}','{$user_role}','{$user_username}','{$user_email}','{$hashed_password}')";

        $create_user_query = mysqli_query($connection, $query);

        confirm_query($create_user_query);
    }
}

function view_all_users () {
    global $connection;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    // Find all posts query
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_username</td>";
        echo "<td>$user_first_name</td>";
        echo "<td>$user_last_name</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='users.php?subscriber={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete_user={$user_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function change_user_roles () {
    global $connection;
    // Admin change
    if (isset($_GET['admin'])) {
        $the_user_id = $_GET['admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
        $admin_query = mysqli_query($connection, $query);

        header("location: users.php");
    }

    // Sub change
    if (isset($_GET['subscriber'])) {
        $the_user_id = $_GET['subscriber'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
        $sub_query = mysqli_query($connection, $query);

        header("location: users.php");
    }
}

function delete_user () {
    global $connection;
    // Deleting comments
    if (isset($_GET['delete_user'])) {
        $the_user_id = $_GET['delete_user'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection, $query);

        header("location: users.php");
    }
}

function edit_user () {
    global $connection, $username, $user_image;
    if (isset($_POST['edit_user'])) {
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        $user_profile_image = $_FILES['user_pfp']['name'];
        $user_profile_image_temp = $_FILES['user_pfp']['tmp_name'];

        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        if (!$select_randsalt_query) {
            die("Query Failed " . mysqli_error($connection));
        }

        move_uploaded_file($user_profile_image_temp, "../images/$user_profile_image");

        if (!empty($user_profile_image)) {
            $query = "UPDATE users SET user_image = '{$user_profile_image}' WHERE user_username = '{$username}' ";
            $update_user = mysqli_query($connection, $query);
        }

        $query = "UPDATE users SET ";
        $query .= "user_username = '{$user_username}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_first_name = '{$user_first_name}', ";
        $query .= "user_last_name = '{$user_last_name}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_username = '{$username}' ";

        $_SESSION['username'] = $user_username;
        $_SESSION['firstname'] = $user_first_name;
        $_SESSION['lastname'] = $user_last_name;
        $_SESSION['user_image'] = $user_image;
        $_SESSION['user_role'] = $user_role;

        $update_user = mysqli_query($connection, $query);

        confirm_query($update_user);
    }
}

//***********************************//
// ------- COMMENTS FUNCTIONS --------
//***********************************//

function view_all_comments () {
    global $connection;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    // Find all posts query
    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_status</td>";

        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
        $update_query = mysqli_query($connection, $query);
        $select_posts_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts_id)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }

        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Decline</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function approve_comment () {
    global $connection;
    // Approve comment
    if (isset($_GET['approve'])) {
        $the_comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
        $approve_query = mysqli_query($connection, $query);

        header("location: comments.php");
    }
}

function unapprove_comment () {
    global $connection;
    // Unapprove comment
    if (isset($_GET['unapprove'])) {
        $the_comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'Declined' WHERE comment_id = $the_comment_id";
        $decline_query = mysqli_query($connection, $query);

        header("location: comments.php");
    }
}

function delete_comment () {
    global $connection;
    // Deleting comments
    if (isset($_GET['delete'])) {
        $the_comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($connection, $query);

        header("location: comments.php");
    }
}
?>