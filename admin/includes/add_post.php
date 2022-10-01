<?php
    if(isset($_POST["create_post"])){
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category_id"];
        $post_author = $_POST["post_author"];
        $post_status = $_POST["post_status"];
        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"];
        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date = date('d-m-y');
        $post_comment_count = 0;
            if(empty($post_title)){
                echo "<div class='alert alert-danger'>";
                echo "<strong>Failed!</strong> Post Title can't be blank.";
                echo "</div>";
            }else{
            move_uploaded_file($post_image_temp, "../images/$post_image");
            $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status,post_view_counts)";
            $query .= "VALUES('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status',0)";
            $insert_post_queery_result = mysqli_query($conn,$query);
            confirm_query($insert_post_queery_result);
            $last_id = mysqli_insert_id($conn);
            echo "<div class='alert alert-success'>";
            echo "<strong>Success!</strong> Post Added. <a href = '../post.php?post_id=$last_id'>View Post</a> or back to <a href = 'posts.php'>View All Posts</a>";
            echo "</div>";
            }
    }



?>





  

<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for = "post_title">Post TItle</label>
        <input type="text" class="form-control" name = "post_title" id = "post_title">
    </div>
    <div class="form-group">
        <label for = "post_category_id">Post Category Id</label><br>
            <select name="post_category_id" id="post_category_id">
                <?php 
                   $result = get_all_sql_result("categories");
                   confirm_query($result);
                   while($rowOption = mysqli_fetch_assoc($result)){
                    echo "<option value = '$rowOption[cat_id]'>$rowOption[cat_title]</option>";
                   }
                ?>
            </select>
    </div>
    <div class="form-group">
        <label for = "post_author">Post Author</label>
        <input type="text" class="form-control" name = "post_author" id = "post_author">
    </div>
    <div class="form-group">
        <label for = "post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for = "post_image">Post Image</label>
        <input type="file" class="form-control" name = "post_image" id = "post_image">
    </div>
    <div class="form-group">
        <label for = "post_tags">Post Tags</label>
        <input type="text" class="form-control" name = "post_tags" id = "post_tags">
    </div>
    <div class="form-group">
        <label for = "post_content">Post Content</label>
        <textarea type="text" class="form-control" id = "post_content" name = "post_content" cols = "30" 
        rows = "10"></textarea>
    </div>
    <div class="form-group">        
        <input type="submit" class="btn btn-primary" name = "create_post" value = "Create">
    </div>
</form>
