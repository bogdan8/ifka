<?php
include '../config.php';
?>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ifka</title>
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link href="../css/font-awesome.css" rel="stylesheet">
  <link rel="icon" href="../img/ico.ico" type="image/x-icon">
  <link rel="shortcut icon" href="../img/ico.ico" type="image/x-icon">
  <link rel="stylesheet/less" href="../css/main.less" />
  <script type="text/javascript" src="../js/less.js"></script>
  <link rel="stylesheet" type="text/css" href="../fancybox/scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  <link rel="stylesheet" href="../fancybox/jquery.fancybox.css" type="text/css" media="screen" /> 
 <div class="foncolor navbar navbar-inverse navbar-fixed-top">
  <div class="container">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
     <span class="sr-only">Відкрити меню</span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="../index.php"> ifka </a>
   </div>
   <div class="collapse navbar-collapse" id="responsive-menu">
    <ul class="nav navbar-nav">  
     <li><a href="index.php"><i class="fa fa-book fa-fw"></i>Всі новини</a></li>
     <li><a href="addnews.php"><i class="fa fa-book fa-fw"></i>Додати новину</a></li>
     <li><a href="addphoto.php"><i class="fa fa-picture-o fa-fw"></i>Додати фото</a></li>
     <li><a href="addvideo.php"><i class="fa fa-video-camera fa-fw"></i>Додати відео</a></li>
    </ul>
    <!-- Search -->

    <form class="form-wrapper" name="search" method="post" action="search.php">
     <input  type="search" name="query" placeholder="Пошук" />
     <input class="btn btn-success" type="submit" value="Пошук" id="submit" /><br />
    </form>

    <!-- Search -->
   </div>
  </div>
 </div>
 <div class="container" style="margin-top: 50px; text-align: center;">
  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="nameform">Додати відео:	 </p>
    <?php
    if(isset($_POST['addvideo'])){
      $name=$_POST['name'];
      $linkvideo=$_POST['linkvideo'];
      $hsl=mysql_query(
          "INSERT into `video` VALUES ('', '$name', '$linkvideo')");
      if($hsl){
        echo "<script>alert('Додано')</script>";
      }else{
        echo "<script>alert('Помилка')</script>";
      }
    }
    ?>

    <form action="" method="POST">
     <table>
      <tr>
       <td style="margin-left: 50px;">
        <br><label  class="nameform"> Імя: </label>
        <br><input type="text" name="name" />
       </td>
       <td></td>
      </tr>
      <tr>
       <td style="margin-left: 50px;">
        <br><label  class="nameform"> Посилання на відео: </label>
        <br><textarea rows="1" cols="20" name="linkvideo" ></textarea>
       </td>
       <td></td>
      </tr>
      <tr>
       <td style="margin-left: 50px;">
        <br><input class="btn btn-success" type="submit" name="addvideo" value="Додати" />
       </td>
       <td></td>
      </tr>
     </table>
    </form>
   </div>
  </div>
 </div>

