<?php
    if(isset($_POST["create_user"])){
        $user_firstname = $_POST["user_firstname"];
        $user_lastname = $_POST["user_lastname"];
        $user_role = $_POST["user_role"];
        $user_username = $_POST["user_username"];
        //$post_image = $_FILES["post_image"]["name"];
        //$post_image_temp = $_FILES["post_image"]["tmp_name"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
         
        //password encryption
        $get_ranSaltQuery = "SELECT user_randSalt FROM users";
        $get_ranSaltQuery_result = mysqli_query($conn,$get_ranSaltQuery);
        confirm_query($get_ranSaltQuery_result);
        $get_ranSaltQuery_result_row = mysqli_fetch_assoc($get_ranSaltQuery_result);
        $user_password = crypt($user_password,$get_ranSaltQuery_result_row['user_randSalt']);

       // move_uploaded_file($post_image_temp, "../images/$post_image");
        $query = "INSERT INTO users(user_username,user_password,user_firstname,user_lastname,user_email,user_role)";
        $query .=          "VALUES('$user_username','$user_password','$user_firstname','$user_lastname','$user_email','$user_role')";
        $insert_user_queery_result = mysqli_query($conn,$query);
        confirm_query($insert_user_queery_result);

        echo "<div class='alert alert-success'>";
        echo "<strong>Success!</strong> User Added. Back to <a href = 'users.php'>View All Users</a>";
        echo "</div>";
    }





?>

<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for = "user_firstname">First Name</label>
        <input type="text" class="form-control" name = "user_firstname" id = "user_firstname">
    </div>
    <div class="form-group">
        <label for = "user_lastname">Last Name</label>
        <input type="text" class="form-control" name = "user_lastname" id = "user_lastname">
    </div>
    <select name="user_role" id="user_role">
        <option value="subscriber">Select Options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
    <div class="form-group">
        <label for = "user_username">Username</label>
        <input type="text" class="form-control" name = "user_username" id = "user_username">
    </div>
    <div class="form-group">
        <label for = "user_email">Email</label>
        <input type="text" class="form-control" name = "user_email" id = "user_email">
    </div>
    <div class="form-group">
        <label for = "user_password">Password</label>
        <input type="password" class="form-control" name = "user_password" id = "user_password">
    </div>
    
    </div>
    <div class="form-group">        
        <input type="submit" class="btn btn-primary" name = "create_user" value = "Create">
    </div>
</form>