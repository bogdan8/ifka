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
 <div class="container" style="margin-top: 50px;">
  <div class="row">

      <p class="nameform">Додати фото:	 </p>
      <?php
      if(isset($_POST['log'])){
        $nm=$_POST['nm'];
        $ds=$_POST['dl'];
        $idcat=$_POST['cat'];
        foreach($_FILES['files']['tmp_name'] as $key=> $name_tmp){
          $name=date("Ymdgis").$_FILES['files']['name'][$key];
          $tmpnm=$_FILES['files']['tmp_name'][$key];
          $type=$_FILES['files']['type'][$key];
          $size=$_FILES['files']['size'][$key];
          $dir="../photo/".$name;
          $move=move_uploaded_file($tmpnm,$dir);
          if($move){
            $hsl=mysql_query(
                "INSERT into `photo` VALUES ('', '$nm', '$ds', '$name', '$type', '$size','$idcat')");
            if($hsl){
              echo "<script>alert('Добавлено')</script>";
            }else{
              echo "<script>alert('Помилка бази данних')</script>";
            }
          }else{
            echo "<script>alert('Помилка папки')</script>";
          }
        }
      }
      ?>
      <form action="" method="POST" enctype="multipart/form-data">
       <table>
        <tr>
         <td style="margin-left: 50px;"><br>
          <label  class="nameform"> Фото: </label>
          <input type="file" name="files[]" />
           </td>
         <td></td>
        </tr>
        <tr>
         <td style="margin-left: 50px;"><br>
          <label class="nameform"> Імя: </label><br>
          <input type="text" name="nm" />
         </td>
         <td></td>
        </tr>
        <tr>
         <td style="margin-left: 50px;"><br>
          <label class="nameform"> Опис: </label><br>
          <textarea rows="1" cols="20" name="dl" ></textarea>
         </td>
         <td></td>
        </tr>
        <tr>
         <td style="margin-left: 50px;"><br>
          <select name="cat">
           <option value="0">Без категорії</option>
           <?php
           $res=mysql_query('SELECT `id_cat`, `name_cat` FROM `category`');
           while($row=mysql_fetch_assoc($res)){
             ?>
             <option value="<?=$row['id_cat']?>"><?=$row['name_cat']?></option>
             <?php
           }
           ?>
          </select>
         </td>
         <td></td>
        </tr>
        <tr>
         <td>
          <p><br>
           <input class="btn btn-success" type="submit" name="log" value="Додати" />
          </p>
         </td>
         <td></td>
        </tr>
       </table>				
      </form>

  </div>  
  </div>
 </div>

