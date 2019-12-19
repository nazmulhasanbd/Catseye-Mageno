<?php include('inc/header.php') ?>
<?php 
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	header('Location: http://www.example.com/');
}
else{

$id = $_GET['id'];

}

?>

<div class="contentsection contemplete clear">
<div class="maincontent clear">
  <div class="about">
    <?php 

$query = "select * from tbl_post where id=$id";
$post = $db->select($query);
if ($post) {
	while ($result = $post->fetch_assoc()) {
	
?>
    <h2><a href="post.php?id=<?php echo $result['id'];  ?>"></h2>
    <h4><?php echo $fm->formatDate($result['date']);  ?>, By Delowar</h4>
    <a href="#"><img src="admin/<?php echo $result['img'];  ?>" alt="post image"/></a> <?php echo $result['body'];  ?>
   
    <div class="relatedpost clear">
      <h2>Related articles</h2>

       <?php 
$catid = $result['cat'];
$queryrelated = "select * from tbl_post where cat='$catid' order by rand()";
$relatedpost = $db->select($queryrelated);
if ($relatedpost ) {
	while ($rresult = $relatedpost ->fetch_assoc()) {
	
?>
      <a href="post.php?id=<?php echo $rresult['id'];  ?>"><img src="admin/<?php echo $rresult['img'];  ?>" alt="post image"/></a>
      <?php } } else{ echo "no releted post";} ?>
    </div>
    <?php } }  else { header('Location: http://www.example.com/'); } ?>
  </div>
</div>
<?php include('inc/sidebar.php') ?>
<?php include('inc/footer.php') ?>
