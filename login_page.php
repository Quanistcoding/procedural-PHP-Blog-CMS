<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Log in</h1>
                     <form action="../includes/login.php" method="post">
                        <div class="form-group">
                        <input name = "username" type="text" class="form-control" id = "username" placeholder = "Enter Username">
                        </div>
                        <div class="input-group">
                        <input name = "password" type="password" class="form-control" id = "password"  placeholder = "Enter Password">
                            <span class="input-group-btn"> 
                                <button class="btn btn-primary" type="submit" name = "login" value = "submit">Submit</span>
                            </button>
                            </span>
                            </div>
                    </form>
                 
                </div>
            </div>
        </div> 
    </div> 
</section>


        <hr>



<?php include "includes/footer.php";?>


