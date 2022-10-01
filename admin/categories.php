<?php include "includes/admin_header.php"?>

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
                        <div class="col-xs-6">

                        <?php 
                           insert_categories();
                        ?>

                            <form action="categories.php" method = "POST">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input id = "cat-title" class = "form-control" type="text" name = "cat_title">
                                </div>
                                <div class="form-group">
                                    <input class = "btn btn-primary" type="submit" name = "submit">
                                </div>
                            </form>

                            <?php //UPDATE AND INCLUDE UPDATE_CATEGORIES.PHP
                            if(isset($_GET["edit"])){
                            $cat_id = $_GET["edit"];
                            include "includes/update_categories.php";
                            }
                            ?>

                        </div>
                       
                        <div class="col-xs-6">
                            <table class = "table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // DELETE A CATEGORY
                                        delete_categories();
                                    ?>
                                    <?php //FIND ALL CATEGORIES
                                        find_all_categories();
                                    ?>
                                </tbody>
                            </table>
                        </div>

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