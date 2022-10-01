<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">My BLog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php  
                        $sql_result = get_all_sql_result("categories");
                        while($row = mysqli_fetch_assoc($sql_result)){
                            echo  "<li> 
                            <a href='#'>$row[cat_title]</a>
                            </li>";
                        };
                    ?>
                    <li><a href="registration.php">Register</a></li>
                    <?php if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin")echo "<li><a href='admin/'>Admin</a></li>"; ?>
                    <?php
                        if(isset($_SESSION["user_role"]) && isset($_GET["post_id"])){
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id=$_GET[post_id]'>Edit Post</a></li>";
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
