<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // clean up data to prevent SQL injection or other bad things
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        die(strtoupper("query failed ") . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_username'];
        $db_user_password = $row['user_password'];
        $db_user_first_name = $row['user_first_name'];
        $db_user_last_name = $row['user_last_name'];
        $db_user_role = $row['user_role'];
    }

    $password = crypt($password, $db_user_password);
    
    if($username === $db_user_name && $password === $db_user_password){

        // make db information available to anywhere on server
        $_SESSION['username'] = $db_user_name;
        $_SESSION['firstname'] = $db_user_first_name;
        $_SESSION['lastname'] = $db_user_last_name;
        $_SESSION['user_role'] = $db_user_role;
        header("location: ../admin");

    }  else {
        header("location: ../");
    }
}
?>