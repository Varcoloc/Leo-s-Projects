<?php
// including database and header of the html
include "includes/db.php";
include "includes/header.php";
session_start();
$username = $_SESSION['username'];
?>

<?php include "includes/nav.php"?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php

                if (isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];

                    if (!isset($_SESSION['username'])){
                        //updating view counts
                        $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $post_id";
                        $update_view_count = mysqli_query($connection, $query);
                    }

                }

                $query = "SELECT * FROM posts WHERE post_id = $post_id";

                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    // Grab the main components that will be shown
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_views = $row['post_view_count'];
            ?>

            <!-- First Blog Post -->
            <h2>
                    <?php echo $post_title; ?>
            </h2>
            <p class="lead">
                by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
                    <?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo date('Y-M-d', strtotime($post_date)); ?>
            </p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>" draggable="false">
            <br>
            <p>
                <?php echo $post_content; ?>
            </p>
            <hr>
            <?php }?>

            <!-- Blog Comments -->

            <?php
                $query = "SELECT user_image FROM users WHERE user_username = '{$username}'";
                $select_user_img_query = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($select_user_img_query);
                $author_img = $row['user_image'];

                if (isset($_POST['post_comment'])){
                    // get URL from $_GET superglobal
                    $post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_author_email'];
                    $comment_content = $_POST['comment_body'];

                    if(isset($_SESSION['username'])){
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_author_img, comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '{$comment_author}', '{$author_img}', '{$comment_email}', '{$comment_content}', 'pending approval', now())";
                    } else {
                        $query = "INSERT INTO comments (comment_post_id, comment_author,  comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'pending approval', now())";
                    }

                    $create_comment_query = mysqli_query($connection, $query);
                    if(!$create_comment_query){
                        die(strtoupper("query failed ") . mysqli_error($connection));
                    }

                    // adding a new comment count to specific post
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                    $update_comment_count = mysqli_query($connection, $query);
                }
            ?>

            <!-- Comments Form -->
            <div class="text-secondary">
            <i class="far fa-eye"></i> <?php echo $post_views; ?>
            </div>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Your Name" name="comment_author" id="comment_author" required="true">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Your Email" name="comment_author_email" id="comment_author_email" required="true">
                    </div>
                    <div class="form-group">
                        <textarea name="comment_body" placeholder="type your message here..." class="form-control" rows="3" required="true"></textarea>
                    </div>
                    <button type="submit" name="post_comment" class="btn btn-primary">Add Comment</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
                // DESC means descending (getting the comments in order of post)
                $query = "SELECT * FROM comments WHERE comments.comment_post_id = {$post_id} AND comments.comment_status = 'Approved' ORDER BY comments.comment_id DESC";
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query){
                    die(strtoupper("query failed ") . mysqli_error($connection));
                }
                while($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    $comment_author_image = $row['comment_author_img'];
                ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <div style="width: 64px; height:64px; max-width:64px; max-height:64px; overflow:hidden;">
                        <img class="img-fluid" src="<?php
                            if (empty($comment_author_image)) {
                                echo "http://placehold.it/64x64";
                            } else {
                                echo "images/$comment_author_image";
                            }
                            ?>" style="width: 64px; min-height:64px; object-fit:cover; object-position: 50% 50%;" alt="author image">
                    </div>
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo date('F d Y', strtotime($comment_date)) . " at " . date('g:ia', strtotime($comment_date)); ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>
        <?php } ?>

        </div>

        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

    <?php include "includes/footer.php";?>