<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Status</th>
            <th>In Relation To</th>
            <th>Date</th>
            <th colspan='4'>Comment Options</th>
        </tr>
    </thead>
    <tbody>
        <?php view_all_comments(); ?>
    </tbody>
</table>

<?php
approve_comment();
unapprove_comment();
delete_comment();
?>