<?php include('inc/header.php') ?>
<?php include('inc/sidebar.php') ?>

<?php

if (!isset($_GET['catid']) ||  $_GET['catid'] == NULL  ) {
  header("Location:catlist.php");
}

else{

$id = $_GET['catid'];

}

?>





        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];

    if (empty($name)) {
        echo "<span class='error'>Field Must Not Be Empty</span>";
    }
else{


        $query = "update tbl_category SET name='$name' where id='$id'";
        $update_row = $db->update($query);

        if ($update_row) {
            echo "category updated successfully";
        }

        else{


            echo "category not updated successfully";

        }

}
    }
?>



<?php

$query = "select * from tbl_category where id=$id order by id desc";
$category = $db->select($query);
while ($result = $category->fetch_assoc()) {
   

?>

                 <form method="post" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

<?php } ?>

                </div>
            </div>
        </div>
       
<?php include('inc/footer.php') ?>