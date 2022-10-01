<table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM comments";
                                    $query_result = mysqli_query($conn,$query);
                                    if(!$query_result)die("Query Failed") . mysqli_error($conn);
                                    while($row = mysqli_fetch_assoc($query_result)){
                                        $post_id = $row["comment_post_id"];

                                        echo "<tr>";
                                        echo "<td>$row[comment_id]</td>";
                                        echo "<td>$row[comment_author]</td>";
                                        echo "<td>$row[comment_content]</td>";
                                        echo "<td>$row[comment_email]</td>";
                                        echo "<td>$row[comment_status]</td>";

                                        $get_post_query = "SELECT * FROM posts WHERE post_id = $post_id";
                                        $get_post_query_result = mysqli_query($conn,$get_post_query);
                                        if($get_post_query_result_row = mysqli_fetch_assoc($get_post_query_result)){
                                            echo "<td><a href = '../post.php?post_id=$post_id'>$get_post_query_result_row[post_title]</a></td>";
                                        }else{
                                            echo "<td> </td>";
                                        }  

                                        echo "<td>$row[comment_date]</td>";
                                        echo "<td><a href = 'comments.php?approve={$row['comment_id']}'>Approved</a></td>";  
                                        echo "<td><a href = 'comments.php?unapprove={$row['comment_id']}'>Unapproved</a></td>";  
                                        echo "<td><a href = 'comments.php?delete={$row['comment_id']}'>Delete</a></td>";                                       
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>


            <?php //DELETE COMMENT
                if(isset($_GET["delete"])){
                    $comment_id = $_GET["delete"];
                    //FIND THE CORRESPONDING POST_ID TO DECREASE ITS COMMENT COUNT
                    $get_comment_in_response_to_query = "SELECT comment_post_id FROM comments WHERE comment_id = $comment_id";
                    $get_comment_in_response_to_query_result = mysqli_query($conn,$get_comment_in_response_to_query);
                    $get_comment_in_response_to_query_result_row = mysqli_fetch_assoc($get_comment_in_response_to_query_result);
                    //EXECUTE DELETE
                    $delete_query = "DELETE FROM comments WHERE comment_id = $comment_id";
                    $delete_query_result = mysqli_query($conn,$delete_query);
                    if(confirm_query($delete_query_result)){
                        //EXECUTE DELETE COMMENT COUNT DECREASE
                        $decrease_post_comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count -1 WHERE post_id = $get_comment_in_response_to_query_result_row[comment_post_id]";
                        mysqli_query($conn,$decrease_post_comment_count_query);
                    }
                    header("Location:comments.php");
                }
            ?>

            <?php //APPROVE COMMENT
                if(isset($_GET["approve"])){
                    $approve_query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $_GET[approve]";
                    $approve_query_result = mysqli_query($conn,$approve_query);
                    confirm_query($approve_query_result);
                    header("Location:comments.php");
                }
            ?>
            <?php //UNAPPROVE COMMENT
                if(isset($_GET["unapprove"])){
                    $unapprove_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $_GET[unapprove]";
                    $unapprove_query_result = mysqli_query($conn,$unapprove_query);
                    confirm_query($unapprove_query_result);
                    header("Location:comments.php");
                }
            ?>
            