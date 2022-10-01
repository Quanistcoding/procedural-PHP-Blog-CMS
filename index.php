<?php include "includes/header.php"?>

<!-- Navigation -->
<?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!--  Blog Post -->
                <?php 
                $get_all_published_posts_query = "SELECT * FROM posts WHERE post_status = 'published'";

                $get_all_published_posts_query_result = mysqli_query($conn,$get_all_published_posts_query); 
                
                while($row = mysqli_fetch_assoc( $get_all_published_posts_query_result)){ 
                    ?>
                
                
                <h2>
                    <a href="/post.php?post_id=<?php echo $row['post_id']?>"><?php echo $row['post_title']?></a>
                </h2>
                <p class="lead">
                    by <a href="posts_of_author.php?author=<?php echo $row['post_author']?>"><?php echo $row['post_author']?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $row['post_date']?></p>
                <hr>
                <a href="/post.php?post_id=<?php echo $row['post_id']?>">
                    <img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt="">
                </a>
                <hr>
                <div><?php echo substr($row['post_content'],0,10)?></div>
                <a class="btn btn-primary" href="/post.php?post_id=<?php echo $row['post_id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>
       