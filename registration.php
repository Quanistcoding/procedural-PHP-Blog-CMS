<?php  include "includes/header.php"; ?>
<?php  
$message = "";
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_role= $_POST["user_role"];
    //Input Validation
    if(empty($username)||empty($email)||empty($password)){
        $message = "Fields can't be empty!!";
    }else{
        $message = "You are registered! Go <a href = 'login_page.php'>Log in</a>";
        //Escape input data
        $username = mysqli_real_escape_string($conn,$username);
            
        $email = mysqli_real_escape_string($conn,$email);
        $password = mysqli_real_escape_string($conn,$password);
        $user_role = mysqli_real_escape_string($conn,$user_role);

        $get_ranSaltQuery = "SELECT user_randSalt FROM users";
        $get_ranSaltQuery_result = mysqli_query($conn,$get_ranSaltQuery);
        confirm_query($get_ranSaltQuery_result);
        $get_ranSaltQuery_result_row = mysqli_fetch_assoc($get_ranSaltQuery_result);
        $password = crypt($password,$get_ranSaltQuery_result_row['user_randSalt']);

        $query = "INSERT INTO users(user_username,user_password,user_email,user_role)";
        $query .=          "VALUES('$username','$password','$email','$user_role')";
        $insert_user_queery_result = mysqli_query($conn,$query);
        confirm_query($insert_user_queery_result);
    }
}


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h2 class = "text-center text-danger"><?php echo $message?></h2>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="user_role" id="">
                                <option value="admin">Admin</option>
                                <option value="subscriber">Subscriber</option>
                            </select>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
