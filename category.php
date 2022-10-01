<?php include "includes/header.php"?>

<!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                
                <!--  Blog Post -->
                <?php  if(!empty($_GET['category_id'])){
                    $cat_id =  $_GET['category_id'];
                    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id";
                    $search_sql_result = mysqli_query($conn,$query);
                    if(!$search_sql_result){
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                    if(mysqli_num_rows($search_sql_result) == 0)echo "<h1>NO RESULT</h1>";
                } ?>
                <?php 
                while($row = mysqli_fetch_assoc($search_sql_result)){ 
                    ?>
                
                
                <h2>
                    <a href="#"><?php echo $row['post_title']?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['post_author']?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $row['post_date']?></p>
                <hr>
                <img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt="">
                <hr>
                <p><?php echo substr($row['post_content'],0,10)?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>
       