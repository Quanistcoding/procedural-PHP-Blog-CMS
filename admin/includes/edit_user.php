<?php

    $user_id = $_GET["user_id"];
    // display input values
    $get_user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $get_user_query_result = mysqli_query($conn,$get_user_query);
    while($row = mysqli_fetch_assoc($get_user_query_result)){
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_role = $row["user_role"];
        $user_username = $row["user_username"];
        $user_email = $row["user_email"];
        $db_user_password = $row["user_password"];
    }

    if(isset($_POST["edit_user"])){
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];
        $user_username = $_POST["user_username"];
        //$post_image = $_FILES["post_image"]["name"];
        //$post_image_temp = $_FILES["post_image"]["tmp_name"];
        $user_email = $_POST["user_email"];
        $original_user_password = $_POST["user_password"];

        //password encryption
        $get_ranSaltQuery = "SELECT user_randSalt FROM users";
        $get_ranSaltQuery_result = mysqli_query($conn,$get_ranSaltQuery);
        confirm_query($get_ranSaltQuery_result);
        $get_ranSaltQuery_result_row = mysqli_fetch_assoc($get_ranSaltQuery_result);
        $user_password = crypt($original_user_password,$get_ranSaltQuery_result_row['user_randSalt']);

       // move_uploaded_file($post_image_temp, "../images/$posts_image");
       if($original_user_password === $db_user_password){
        $query =  "UPDATE users SET ";
        $query .= "user_firstname = '$user_firstname',";
        $query .= "user_lastname = '$user_lastname',";
        $query .= "user_role = '$user_role',";
        $query .= "user_username = '$user_username',";
        $query .= "user_email = '$user_email' ";
        $query .= "WHERE user_id = $user_id";
       }else{
        $query =  "UPDATE users SET ";
        $query .= "user_firstname = '$user_firstname',";
        $query .= "user_lastname = '$user_lastname',";
        $query .= "user_role = '$user_role',";
        $query .= "user_username = '$user_username',";
        $query .= "user_email = '$user_email',";
        $query .= "user_password = '$user_password' ";
        $query .= "WHERE user_id = $user_id";
        }   
         $update_user_queery_result = mysqli_query($conn,$query);
         confirm_query($update_user_queery_result);
         //User updated message
         echo "User updated <a href = 'users.php'>View All Users</a>";
    }

?>


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
            $current_user_role =  $user_role ?? "subscriber";
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
        <input type="password" class="form-control" name = "user_password" id = "user_password" value = "<?php echo $db_user_password ?>">
    </div>
    
    </div>
    <div class="form-group">        
        <input type="submit" class="btn btn-primary" name = "edit_user" value = "Update">
    </div>
</form>