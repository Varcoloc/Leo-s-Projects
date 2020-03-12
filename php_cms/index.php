<?php
// including database and header of the html
include "includes/db.php";
include "includes/header.php";
session_start();
?>

<?php include "includes/nav.php" ?>

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
                // pagination mySQL LIMIT
                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                    $previous = $page - 1;
                    $next = $page + 1;
                } else {
                    $page = "";
                }

                if ($page == "" || $page == 1){
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * 3) - 3;
                }

                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);

                $count = ceil($count/2);

                $query = "SELECT * FROM posts LIMIT $page_1, 3";

                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    // Grab the main components that will be shown
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 300);
                    $post_status = $row['post_status'];

                    if ($post_status == 'Published'){
            ?>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
                    <?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo date('Y-M-d', strtotime($post_date)); ?>
            </p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>" draggable="false">
            </a>
            <br>
            <p>
                <?php echo $post_content; ?>
            </p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <?php   }}   ?>


        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <div class="text-center">
        <ul class="pagination">
        <li class="page-item">
        <?php if ($page > 1) {
            ?>
        <a class="page-link" href="<?php echo 'index.php?page=' . $previous; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        <?php }?>
        </li>
        <?php
            for ($i=1; $i <= $count; $i++) { 
                if ($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                }
            }
        ?>
        <?php if ($page < $count){ ?>
        <li class="page-item">
        <a class="page-link" href="<?php echo 'index.php?page=' . $next; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
        </a>
        </li>
        <?php } ?>
        </ul>
    </div>

    <?php include "includes/footer.php"; ?>