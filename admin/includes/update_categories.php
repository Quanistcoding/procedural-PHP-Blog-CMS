<form action="" method = "POST">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        
        <?php //UPDATE GOES BEFORE DISPLAY
            if(isset($_POST["update_categoty"])){            
                $edit_query = "UPDATE categories SET cat_title = '$_POST[cat_title]' WHERE cat_id = $cat_id";              
                $edit_query_result = mysqli_query($conn,$edit_query);
                if(!$edit_query_result){
                    die("Query Failed") . mysqli_error($conn);
                }
            }  
        ?>

        <?php //DISPLAY CATEGORY TO EDIT
            if(isset($_GET["edit"])){
                $cat_id = $_GET["edit"];
                $display_edit_query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $edit_query_result = mysqli_query($conn,$display_edit_query);
                $row = mysqli_fetch_assoc($edit_query_result);
                ?>
                <input id = 'cat-title' class = 'form-control' type='text' name = 'cat_title' value = <?php if(isset($row["cat_title"]))echo $row["cat_title"]?>>        
        <?php    }?>

    </div>
    <div class="form-group">
        <input class = "btn btn-primary" type="submit" name = "update_categoty" value = "Update Category">
    </div>
</form>