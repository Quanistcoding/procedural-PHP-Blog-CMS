<?php include "includes/admin_header.php"?>
<?php 
    $user_id = $_SESSION["user_id"];
    //Display Profile Form Values
    $get_user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $get_user_query_result = mysqli_query($conn,$get_user_query);
    while($row = mysqli_fetch_assoc($get_user_query_result)){
        $user_username = $row["user_username"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_role = $row["user_role"];
        $user_password = $row["user_password"];
    }

    //Update User    
    if(isset($_POST["edit_user"])){
        $user_username = $_POST["user_username"];
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_email = $_POST["user_email"];
        $user_role = $_POST["user_role"];
        $user_password = $_POST["user_password"];

        $query =  "UPDATE users SET ";
        $query .= "user_firstname = '$user_firstname',";
        $query .= "user_lastname = '$user_lastname',";
        $query .= "user_role = '$user_role',";
        $query .= "user_username = '$user_username',";
        $query .= "user_email = '$user_email',";
        $query .= "user_password = '$user_password' ";
        $query .= "WHERE user_id = $user_id";

        $update_user_queery_result = mysqli_query($conn,$query);
        confirm_query($update_user_queery_result);
    }
?>
    <div id="wrapper">
 
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>author</small>
                        </h1>
                       
                       <!-- Profile Form -->
                       <form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
       
        <label for = "user_firstname">First Name</label>
        <input type="text" class="form-control" name = "user_firstname" id = "user_firstname" value = "<?php echo $user_firstname?>">
    </div>
    <div class="form-group">
        <label for = "user_lastname">Last Name</label>
        <input type="text" class="form-control" name = "user_lastname" id = "user_lastname" value = "<?php echo $user_lastname?>">
    </div>

    <select name="user_role" id="user_role">
        <?php 
            $current_user_role =  $user_role;
            $the_other_user_role = $user_role === "admin" ? "subscriber":"admin";

            echo "<option value='$current_user_role'>$current_user_role</option>";
            echo "<option value='$the_other_user_role'>$the_other_user_role</option>";
        ?>
    </select>
    <div class="form-group">
        <label for = "user_username">Username</label>
        <input type="text" class="form-control" name = "user_username" id = "user_username" value = "<?php echo $user_username?>">
    </div>
    <div class="form-group">
        <label for = "user_email">Email</label>
        <input type="text" class="form-control" name = "user_email" id = "user_email" value = "<?php echo $user_email?>">
    </div>
    <div class="form-group">
        <label for = "user_password">Password</label>
        <input type="password" class="form-control" name = "user_password" id = "user_password" value = "<?php echo $user_password?>">
    </div>
    
    </div>
    <div class="form-group">        
        <input type="submit" class="btn btn-primary" name = "edit_user" value = "Update">
    </div>
</form>





                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"?>