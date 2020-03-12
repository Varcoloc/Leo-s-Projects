<?php
if(isset($_POST['checkBoxesArray'])){
    foreach ($_POST['checkBoxesArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'Published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}'";
                $update_to_published_status = mysqli_query($connection, $query);
                confirm_query($update_to_published_status);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}'";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirm_query($update_to_draft_status);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '{$postValueId}'";
                $delete_selected_posts = mysqli_query($connection, $query);
                confirm_query($delete_selected_posts);
                break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                $clone_selected_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($clone_selected_posts)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_date) VALUES('{$post_author}', '{$post_title}', '{$post_category_id}', 'draft', '{$post_image}', '{$post_tags}', '{$post_content}', now())";
                $copy_selected_posts = mysqli_query($connection, $query);
                confirm_query($copy_selected_posts);
                break;
            
            default:
                # code...
                break;
        }
    }
}
?>

<form action="" method="post">
<table class="table table-bordered table-hover">
    <div class="col-xs-4" id="bulkOptionsContainer" style="padding: 0; margin-bottom: 15px;">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="Published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" value="Apply" class="btn btn-success">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <thead>
        <tr>
            <th><input type="checkbox" name="" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th colspan='3'>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php view_all_posts(); ?>
    </tbody>
</table>
</form>

<?php delete_posts(); ?>