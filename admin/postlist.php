<?php include('inc/header.php') ?>
<?php include('inc/sidebar.php') ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>

						<tr>
							<th>Id</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Images</th>
							<th>Author</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php

					$query = "select tbl_post.*,tbl_category.name from tbl_post
					inner join tbl_category on tbl_post.cat = tbl_category.id
					order by tbl_post.title desc";
					$post = $db->select($query);
					if ($post) {
						$i=0;
						while ($result = $post->fetch_assoc()) {
							$i++;
				

					?>

						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['title'] ?></td>
							<td><?php echo $fm->textShorten($result['body'], 50) ?></td>
							<td><?php echo $result['name'] ?></td>
							<td><img src="<?php echo $result['images'] ?>" height="40px" width="40px"/></td>
							<td><?php echo $result['author'] ?></td>
							<td><?php echo $result['tags'] ?></td>
							<td><?php echo $fm->formatDate($result['date']) ?></td>
							<td><a href="editpost.php?editid=<?php echo $result['id'] ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete');" href="deletepost.php?delpostid=<?php echo $result['id'] ?>">Delete</a></td>
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