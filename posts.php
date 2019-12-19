
<?php include('inc/header.php') ?>
<?php include('inc/slider.php') ?>

<div class="contentsection contemplete clear">
<div class="maincontent clear">

<?php 
if (!isset($_GET['category']) || $_GET['category'] == NULL) {
  header('Location: http://www.example.com/');
}
else{

$id = $_GET['category'];

}

?>

  
  <?php
 $query = "select * from tbl_post where cat=$id";

$post =  $db->select($query);

if ($post) {
  
 while ($result = $post->fetch_assoc()) {
?>
  <div class="samepost clear">
    <h2><a href="post.php?id=<?php echo $result['id'];  ?>"><?php echo $result['title'];  ?></a></h2>
    <h4><?php echo $fm->formatDate($result['date']);  ?><a href="#">Delowar</a></h4>
    <a href="#"><img src="admin/upload/<?php echo $result['img'];  ?>" alt="post image"/></a> <?php echo $fm->textShorten($result['body']);  ?>
    <div class="readmore clear"> <a href="post.php?id=<?php echo $result['id'];  ?>">Read More</a> </div>
  </div>

  

  
  <?php } } else { ?>

<h3>No Post in this category</h3>

  <?php  } ?>
</div>


  <?php include('inc/sidebar.php') ?>
<?php include('inc/footer.php') ?>
