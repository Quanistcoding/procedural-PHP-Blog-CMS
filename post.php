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
                if(!isset($_GET["post_id"]) || empty($_GET["post_id"])){
                    echo "No Result";
                }else{
                    $post_id = $_GET["post_id"];
                    $get_indivisual_post_query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $sql_result = mysqli_query($conn,$get_indivisual_post_query);

                    //Add view count
                    $add_view_count_query = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = $post_id";
                    mysqli_query($conn,$add_view_count_query);
                while($row = mysqli_fetch_assoc($sql_result)){ 
                    
                
                
                ?>
                
                
                <h2>
                    <?php echo $row['post_title']?>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['post_author']?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $row['post_date']?></p>
                <hr>
                <img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt="">
                <hr>
                <p><?php echo  $row['post_content']?></p>
                

                <hr>
            <?php }} ?>
            

            </div>
            </div>
            <!-- Blog Comments -->
            <?php
                if(isset($_POST["submit"])){
                    $comment_author  = $_POST["comment_author"];
                    $comment_email  = $_POST["comment_email"];
                    $comment_content  = $_POST["comment_content"];

                    //Check if any field is empty
                    if(empty($comment_author) || empty($comment_email) || empty($comment_content)){
                        echo "<script>alert('Fields can\'t be empty!!')</script>";
                    }else{
                        $insert_comment_query = "INSERT INTO comments(comment_post_id, comment_author,comment_email, comment_content, comment_status, comment_date) ";
                        $insert_comment_query .= "VALUES($post_id, '$comment_author', '$comment_email', '$comment_content','unapproved',now())";
                        $insert_comment_query_result = mysqli_query($conn,$insert_comment_query);
                        //Update comment count
                        if(confirm_query($insert_comment_query_result)){
                            $increase_comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                            mysqli_query($conn,$increase_comment_count_query);
                            header("Location:post.php?post_id=$post_id");
                        };
                    }
                }
            ?>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action = "" method = "post">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" name = "comment_author" class = "form-control" id = "comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" name = "comment_email" class = "form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name = "comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Display Posted Comments -->
                <?php
                    $get_comments_query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                    $get_comments_query .= "AND comment_status = 'approved' ";
                    $get_comments_query .= "ORDER BY comment_id DESC";
                    $get_comments_query_result = mysqli_query($conn,$get_comments_query);
                    confirm_query($get_comments_query_result);
                    while($get_comments_query_result_row = mysqli_fetch_assoc($get_comments_query_result)){
                ?>
                    
                    <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $get_comments_query_result_row['comment_author']?>
                            <small><?php echo $get_comments_query_result_row['comment_date']?></small>
                        </h4>
                        <?php echo $get_comments_query_result_row['comment_content']?>
                    </div>
                </div>
                    
                    
                <?php } ?>

                

               


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>
       