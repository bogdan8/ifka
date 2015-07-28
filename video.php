<?php
include 'config.php';
include 'util/header.php';
include 'util/sliders.php';
?>
<div class="container">
 <div class="row">
  <?php
  $res=mysql_query('SELECT `name_video`, `link_video` FROM `video`');
  while($row=mysql_fetch_assoc($res)){
    ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-top: 50px;">
     <div class="video">
      <p class="namevideo"><?=$row['name_video']?></p>
      <div class="link_video"><?=$row['link_video']?></div>
     </div>
    </div>
    <?php
  }
  ?>
 </div>
</div>

<?php
include 'util/footer.php';
?>
		