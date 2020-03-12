<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2">Role Selection</th>
            <th colspan="2">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php view_all_users(); ?>
    </tbody>
</table>

<?php
change_user_roles();
delete_user();
?>