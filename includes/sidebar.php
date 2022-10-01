<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        
                        <input name = "search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name = "submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                 <!-- Blog Login -->
                <div class="well">
                    <h4>Login</h4>
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
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                <?php
                    $category_query_result = get_all_sql_result("categories");
                    while($row = mysqli_fetch_assoc($category_query_result)){
                        echo "<li><a href='category.php?category_id=$row[cat_id]'>$row[cat_title]</a>
                        </li>";
                    }
                ?>

                            
                            </ul>
                        </div>
                       
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"?>
                

            </div>