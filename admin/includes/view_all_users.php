<table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>User Role</th>
                                    <th colspan = 2 class="text-center">Set User Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM users";
                                    $query_result = mysqli_query($conn,$query);
                                    if(!$query_result)die("Query Failed") . mysqli_error($conn);
                                    while($row = mysqli_fetch_assoc($query_result)){
                                        $user_id = $row["user_id"];

                                        echo "<tr>";
                                        echo "<td>$user_id</td>";
                                        echo "<td>$row[user_username]</td>";
                                        echo "<td>$row[user_firstname]</td>";
                                        echo "<td>$row[user_lastname]</td>";
                                        echo "<td>$row[user_email]</td>";
                                        echo "<td>$row[user_role]</td>";
                                        echo "<td><a href = 'users.php?admin={$user_id}'>Administrator</a></td>";  
                                        echo "<td><a href = 'users.php?subscriber={$user_id}'>Subscriber</a></td>";  
                                        echo "<td><a href = 'users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";     
                                        echo "<td><a href = 'users.php?delete={$user_id}'>Delete</a></td>";                                       
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>


            <?php //DELETE COMMENT
                if(isset($_GET["delete"])){
                    $user_id = $_GET["delete"];
                    $delete_query = "DELETE FROM users WHERE user_id = $user_id";
                    $delete_query_result = mysqli_query($conn,$delete_query);
                    confirm_query($delete_query_result);
                    header("Location:users.php");
                }
            ?>

            <?php //APPROVE COMMENT
                if(isset($_GET["admin"])){
                    $approve_query = "UPDATE users SET user_role = 'admin' WHERE user_id = $_GET[admin]";
                    $approve_query_result = mysqli_query($conn,$approve_query);
                    confirm_query($approve_query_result);
                    header("Location:users.php");
                }
            ?>
            <?php //UNAPPROVE COMMENT
                if(isset($_GET["subscriber"])){
                    $unapprove_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $_GET[subscriber]";
                    $unapprove_query_result = mysqli_query($conn,$unapprove_query);
                    confirm_query($unapprove_query_result);
                    header("Location:users.php");
                }
            ?>
            