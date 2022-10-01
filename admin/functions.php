<?php
function confirm_query($result){
    global $conn;
    if(!$result){
        die("Query Failed") . mysqli_error($conn);
    }else{
        return true;
    }
}


function insert_categories(){
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be  empty";
        }else{
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUES('$cat_title')";
            $create_category_query = mysqli_query($conn,$query);
            if(!$create_category_query){
                die("Query Failed") . mysqli_error($conn);
            }
        }
    }
    
}

function find_all_categories(){
    global $conn;
    $fetching_category_result = get_all_sql_result("categories");
    while($row = mysqli_fetch_assoc($fetching_category_result)){
        $cat_id = $row["cat_id"];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$row[cat_title]</td>";
        echo "<td><a href = 'categories.php?delete=$cat_id'>Delete<a></td>";
        echo "<td><a href = 'categories.php?edit=$cat_id'>Edit<a></td>";
        echo "</tr>";
    }

}

function delete_categories(){
    global $conn;
    if(isset($_GET["delete"])){
        $delete_query = "DELETE FROM categories WHERE cat_id = $_GET[delete]";
        $delete_query_result = mysqli_query($conn,$delete_query);
        header("location:categories.php");
        }
           
}
?>