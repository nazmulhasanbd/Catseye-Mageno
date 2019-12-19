<?php include('inc/header.php') ?>
<?php include('inc/sidebar.php') ?>
<?php

if (!isset($_GET['editid']) ||  $_GET['editid'] == NULL  ) {
  header("Location:addpost.php");
}

else{

$postid = $_GET['editid'];

}

?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Update Post</h2>
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


    if ($cat == "" || $title == "" || $body == ""  || $tags == "" || $author == ""  ) {

       echo "Field Must not Be Empty";
    }
if (!empty($file_name)) {
    
     if (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{
    move_uploaded_file($file_temp, $uploaded_image);


    $query = "update tbl_post

    set
    title = '$title';
    cat = '$cat';
    body = '$body'
    imges = '$uploaded_image';
    tags = '$tags';
    author = '$author'
    where id='$postid'";

    $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Image Inserted Successfully.
     </span>";
    }else {
     echo "<span class='error'>Image Not Inserted !</span>";
    }


}

}
else{
$query = "update tbl_post

    set
    title = '$title';
    cat = '$cat';
    body = '$body'
    tags = '$tags';
    author = '$author'
    where id='$postid'";

    $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Post Update Successfully.
     </span>";
    }else {
     echo "<span class='error'>Post not Update !</span>";
    }

}



}

    ?>
    <div class="block">
      <?php
$query = "select * from tbl_post where id='$postid'";
$getpost= $db->select($query);
while ($result = $getpost->fetch_assoc()) {
    # code...

?>
      <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
          <tr>
            <td><label>Title</label></td>
            <td><input type="text" name="title" value="<?php echo $result['title'] ?>" class="medium" /></td>
          </tr>
          <tr>
            <td><label>Category</label></td>
            <td><select id="select" name="cat">
                <option>Select Category</option>
                <?php

$query = "select * from tbl_category";
$category = $db->select($query);
if ($category) {

    while ($catresult = $category->fetch_assoc()) {
        

?>
                <option <?php if ($result['cat'] == $catresult['id'] ) { ?>  selected="selected" <?php } ?> value="<?php echo $catresult['id'] ?>"><?php echo $catresult['name'] ?></option>
                <?php } } ?>
              </select></td>
          </tr>
          <tr>
            <td><label>Date Picker</label></td>
            <td><input type="text" id="date-picker" /></td>
          </tr>
          <tr>
            <td><label>Upload Image</label></td>
            <td><img src="<?php echo $result['images'] ?>" height="70px" width="70px"/><br/>
              <input type="file" name="images" /></td>
          </tr>
          <tr>
            <td style="vertical-align: top; padding-top: 9px;"><label>Content</label></td>
            <td><textarea class="tinymce" name="body">
                
<?php echo $result['body'] ?>"

            </textarea></td>
          </tr>
          <tr>
            <td><label>Tags</label></td>
            <td><input type="text" name="tags" value="<?php echo $result['tags'] ?>" class="tags" /></td>
          </tr>
          <tr>
            <td><label>author</label></td>
            <td><input type="text" name="author" value="<?php echo $result['author'] ?>" class="author" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="submit" Value="Save" /></td>
          </tr>
        </table>
      </form>
      <?php } ?>
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
