﻿<?php include('inc/header.php') ?>
<?php include('inc/sidebar.php') ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>


                <?php

                if (isset($_GET['delcat'])) {
                	$delid = $_GET['delcat'];
                	$delquery = "delete from tbl_category where id='$delid'";
                	$deldata = $db->delete($delquery);
                	if ($deldata) {
                		echo "Data Successfully Deleted";
                	}

                	else{

                		echo "category not Deleted";

                	}
                }

                ?>




                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>

<?php

$query = "select * from tbl_category";
$category= $db->select($query);
if ($category) {
	$i=0;
	while ( $result = $category->fetch_assoc()) {
		$i++;


?>

					<tbody>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['name'] ?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id'] ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete');" href="?delcat=<?php echo $result['id'] ?>">Delete</a></td>
						</tr>
						
				<?php } } ?>


					</tbody>
				</table>
               </div>
            </div>
        </div>
      <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>   
<?php include('inc/footer.php') ?>
