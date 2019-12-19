<?php include('inc/header.php') ?>
<?php include('inc/sidebar.php') ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>

                    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cat = $fm->validation($_POST['cat']);
    $title = $fm->validation($_POST['title']);
    $body = $fm->validation($_POST['body']);
    $tags = $fm->validation($_POST['tags']);
    $author = $fm->validation($_POST['author']);
    


    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['images']['name'];
    $file_size = $_FILES['images']['size'];
    $file_temp = $_FILES['images']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;


    if ($cat == "" || $title == "" || $body == "" ||  $file_name == "" || $tags == "" || $author == ""  ) {

       echo "Field Must not Be Empty";
    }

     elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{
    move_uploaded_file($file_temp, $uploaded_image);


    $query = "INSERT INTO tbl_post(cat,title,body,images,author,tags) 

    VALUES('$cat','$title','$body','$uploaded_image','$author','$tags')";
    $inserted_rows = $db->insert($query);
    if ($inserted_rows) {
     echo "<span class='success'>Image Inserted Successfully.
     </span>";
    }else {
     echo "<span class='error'>Image Not Inserted !</span>";
    }


}

}

    ?>




                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                <option>Select Category</option>
                                   


<?php

$query = "select * from tbl_category";
$category = $db->select($query);
if ($category) {

    while ($result = $category->fetch_assoc()) {
        

?>

                         <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>


                  <?php } } ?>
                                </select>



                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="images" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Tag..." class="tags" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>author</label>
                            </td>
                            <td>
                                <input type="text" name="author" placeholder="author..." class="author" />
                            </td>
                        </tr>




						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
       

    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>


    <?php include('inc/footer.php') ?>