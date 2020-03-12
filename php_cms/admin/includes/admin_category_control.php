<!-- Add Category Form -->
<div class="col-xs-6">
    <?php insert_categories(); ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title_admin"><span class="text-danger">*</span>
                <?php if(isset($_GET['edit'])) { echo "Edit"; } else { echo "New"; } ?> Category:</label>
                <?php
                // update categories by id
                if (isset($_GET['edit'])) {
                    $cat_update_id = $_GET['edit'];
                    $query = "SELECT * FROM categories WHERE cat_id = $cat_update_id";
                    $update_query = mysqli_query($connection, $query);
                    $select_categories_id = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_id)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                ?>
            <input class="form-control" type="text" name="cat_title" id="cat_title_admin" placeholder="Category Title"
                value="<?php if(isset($cat_title)){echo $cat_title;} ?>">
            <?php }} ?>

            <?php update_categories(); ?>

            <?php 
                // Making some Misc Dynamic Changes to Toggle Adding and Editing
                if (isset($_GET['edit'])){
                    echo "";
                } else {
                    echo '<input class="form-control" type="text" name="cat_title" id="cat_title_admin" placeholder="Category Title">';
                }
            ?>
        </div>
        <div class="form-group">
            <?php
                if (isset($_GET['edit'])) {
                    echo '<input class="btn btn-primary" type="submit" name="edit_category" value="Edit Category">';
                } else {
                    echo '<input class="btn btn-primary" type="submit" name="submit" value="Add Category">';
                }
            ?>
        </div>
    </form>
</div>
<!-- /. Add Category Form -->
<div class="col-xs-6">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Title</th>
                <th colspan='2'>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php find_all_categories(); ?>
            <?php delete_categories(); ?>
        </tbody>
    </table>
</div>