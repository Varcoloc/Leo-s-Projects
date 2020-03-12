<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group mb-3">
                <input name="search" type="text" class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <?php 
    if(!isset($_SESSION['user_role'])){
        ?>
        <!-- Blog Admin Login Well -->
        <div class="well">
            <h4>User Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input name="username" placeholder="Enter username" type="text" class="form-control" required="true">
                </div>
                <div class="input-group">
                    <input name="password" placeholder="Enter Password" type="password" class="form-control" required="true">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                    </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>
        <?php
    }
    ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <?php
            $query = "SELECT * FROM categories";
            $select_categories_sidebar = mysqli_query($connection, $query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <?php include "widgets.php"; ?>
</div>