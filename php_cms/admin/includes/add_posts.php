<?php add_new_post(); ?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title">Post Title:</label>
            <input class="form-control" type="text" name="post_title" id="post_title">
        </div>
        <div class="form-group">
            <label for="post_category">Post Category:</label>
            <br>
            <select class="custom-select" name="post_category" id="post_category">
                <?php 
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $query);

                    confirm_query($select_categories);

                    while ($row = mysqli_fetch_assoc($select_categories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_author">Author:</label>
            <input class="form-control" type="text" name="post_author" id="post_author">
        </div>
        <div class="form-group">
            <label for="post_status">Status:</label>
            <br>
            <select name="post_status" id="post_status">
                <option value="draft">draft</option>
                <option value="Published">publish</option>
            </select>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <label for="post_image">Post Image</label>
                <input type="file" class="custom-file-input" id="post_image" name="post_image" accept="image/*">
            </div>
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags:</label>
            <input class="form-control" type="text" name="post_tags" id="post_tags">
        </div>
        <div class="form-group">
            <label for="post_content">Post Content:</label>
            <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="30"></textarea>
            <script>
                // Replace the <textarea id="post_content"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'post_content' );
            </script>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" name="publish_post" type="submit" value="Publish Post">
        </div>
    </form>
</div>