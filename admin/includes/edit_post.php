<?php
    if(isset($_GET['p_id'])){
       $p_id = $_GET['p_id'];
    }
    
    

    //UPDATE POST
    if(isset($_POST["edit_post"])){
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category_id"];
        $post_author = $_POST["post_author"];
        $post_status = $_POST["post_status"];
        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"];
        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $get_edit_image_query = "SELECT post_image FROM posts WHERE post_id = $p_id";
            $get_edit_query_result = mysqli_query($conn,$get_edit_image_query);
            confirm_query($get_edit_query_result);
            $rowImage = mysqli_fetch_assoc($get_edit_query_result);
            $post_image = $rowImage["post_image"];

        }

        $update_post_query =  "UPDATE posts SET ";
        $update_post_query .= "post_title = '$post_title', ";
        $update_post_query .= "post_category_id = '$post_category_id', ";
        $update_post_query .= "post_author = '$post_author', ";
        $update_post_query .= "post_date = now(), ";
        $update_post_query .= "post_status = '$post_status', ";
        $update_post_query .= "post_image = '$post_image', ";
        $update_post_query .= "post_tags = '$post_tags', ";
        $update_post_query .= "post_content = '$post_content' ";
        $update_post_query .= "WHERE post_id = $_GET[p_id]";


        $update_post_queery_result = mysqli_query($conn,$update_post_query);
        confirm_query($update_post_queery_result);

        echo "<div class='alert alert-success'>";
        echo "<strong>Success!</strong> Post Updated. <a href = '../post.php?post_id=$p_id'>View Post</a> or "; 
        echo "<a href = 'posts.php'>View All Post</a>";
        echo "</div>";
    }




    // DISPLAY INPUT VALUES

    if(isset($_GET['p_id'])){
        $get_edit_query = "SELECT * FROM posts WHERE post_id = $p_id";
        $get_edit_query_result = mysqli_query($conn,$get_edit_query);
        confirm_query($get_edit_query_result);
        $row = mysqli_fetch_assoc($get_edit_query_result);
    }
 

?>


<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for = "post_title">Post TItle</label>
        <input type="text" class="form-control" name = "post_title" id = "post_title" value = "<?php echo $row['post_title']?>">
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
        <input type="text" class="form-control" name = "post_author" id = "post_author" value = "<?php echo $row['post_author']?>">
    </div>
    <div class="form-group">
    <label for = "post_status">Post Status</label>
    <select name="post_status" id="">
            <?php 
                $post_status = $row["post_status"];
                echo "<option value='$post_status'>".ucfirst($post_status)."</option>";
                if($post_status === "draft"){
                    echo "<option value='published'>Published</option>";
                }else{
                    echo "<option value='draft'>Draft</option>";
                }
                ?>
    </select>
       
    </div>
    <div class="form-group">
        <img src = "../images/<?php echo $row['post_image']?>" alt = "image" width = "100">
    </div>
    <div class="form-group">
        <label for = "post_image">Post Image</label>
        <input type="file" class="form-control" name = "post_image" id = "post_image" value = "<?php echo $row['post_image']?>">
    </div>
    <div class="form-group">
        <label for = "post_tags">Post Tags</label>
        <input type="text" class="form-control" name = "post_tags" id = "post_tags" value = "<?php echo $row['post_tags']?>"> 
    </div>
    <div class="form-group">
        <label for = "post_content">Post Content</label>
        <textarea type="text" class="form-control" id = "post_content" name = "post_content" cols = "30" 
        rows = "10"><?php echo $row['post_content']?>
        </textarea>
    </div>
    <div class="form-group">        
        <input type="submit" class="btn btn-primary" name = "edit_post" value = "Update">
    </div>
</form>