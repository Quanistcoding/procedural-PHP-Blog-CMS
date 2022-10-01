
<?php 
    $option_message = "";
    $select_message = "";
    if(isset($_POST["submit"])){
        $bulk_option_select = $_POST["bulk_option_select"];
        if(!isset($_POST["checkBoxArray"]))$select_message = "Please Select Posts.";
    }
   
    if(isset($_POST["checkBoxArray"])){
        foreach($_POST["checkBoxArray"] as $post_id){
        switch($bulk_option_select){
            case "delete":
                $query = "DELETE FROM posts WHERE post_id = $post_id";
                $query_result = mysqli_query($conn,$query);
                confirm_query($query_result);
                break;
            case "draft":    
                $query = "UPDATE posts SET post_status = '$bulk_option_select' WHERE post_id = $post_id";
                $query_result = mysqli_query($conn,$query);
                confirm_query($query_result);
                break;
            case "published":    
                $query = "UPDATE posts SET post_status = '$bulk_option_select' WHERE post_id = $post_id";
                $query_result = mysqli_query($conn,$query);
                confirm_query($query_result);
                break;
            case "clone":    
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $query = mysqli_query($conn,$query);
                confirm_query($query);
                $row = mysqli_fetch_assoc($query);
                $insert_query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
                $insert_query .= "VALUES('$row[post_category_id]','$row[post_title]','$row[post_author]',now(),'$row[post_image]','$row[post_content]','$row[post_tags]',0,'draft')";
                mysqli_query($conn,$insert_query);
                break;
            default:
                 $option_message = "Please Select An Option.";
                 break;
        }
    }
}
?>
<h2 class = "text-danger"><?php echo $option_message ?></h2>
<h2 class = "text-danger"><?php echo $select_message ?></h2>
<form action="" method = "post">
    <div class="col-xs-4">
        <select style = "padding:0px" class = "form-control" name="bulk_option_select" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name = "submit" class = "btn btn-success" value = "Apply">
        <a class = "btn btn-primary" href = "posts.php?source=add_post">Add New</a>
    </div>



<table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type = "checkbox" id = "selectAllCheckbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>View Counst</th>
                                    <th>Date</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                                    $query_result = mysqli_query($conn,$query);
                                    if(!$query_result)die("Query Failed") . mysqli_error($conn);
                                    while($row = mysqli_fetch_assoc($query_result)){
                                        echo "<tr>";
                                        echo "<td><input class = 'checkboxes' type = 'checkbox' value = '$row[post_id]' name = 'checkBoxArray[]'></td>";
                                        echo "<td>$row[post_id]</td>";
                                        echo "<td>$row[post_author]</td>";
                                        echo "<td>$row[post_title]</td>";

                                        //GET CATEGORY 
                                        $get_category_query = "SELECT * FROM categories WHERE cat_id = $row[post_category_id]";
                                        $get_category_query_result = mysqli_query($conn,$get_category_query);
                                        confirm_query($get_category_query_result);
                                        $get_category_query_result_row = mysqli_fetch_assoc($get_category_query_result);
                                        echo "<td>$get_category_query_result_row[cat_title]</td>";



                                        echo "<td><img width = '100' class = 'img-responsive' src = '../images/$row[post_image]' alt = 'image'></td>";
                                        echo "<td>$row[post_status]</td>";
                                        echo "<td>$row[post_tags]</td>";
                                        echo "<td>$row[post_comment_count]</td>";
                                        echo "<td>$row[post_view_counts]</td>";
                                        echo "<td>$row[post_date]</td>";
                                        echo "<td><a href = '../post.php?post_id={$row['post_id']}'>View</a></td>";
                                        echo "<td><a href = 'posts.php?source=edit_post&source=edit_post&p_id={$row['post_id']}'>Edit</a></td>";
                                        echo "<td><a onclick = 'return confirm(\"Are you sure you want to delete this post?\")' href = 'posts.php?delete={$row['post_id']}'>Delete</a></td>";                                       
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>


            <?php
                if(isset($_GET["delete"])){
                    $delete_query = "DELETE FROM posts WHERE post_id = $_GET[delete]";
                    $delete_query_result = mysqli_query($conn,$delete_query);
                    confirm_query($delete_query_result);
                    header("Location:posts.php");
                }
            ?>
</form>
