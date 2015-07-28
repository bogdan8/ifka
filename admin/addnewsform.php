<?php include '../config.php';?>
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
 <div class="container" style="margin-top: 100px;">
  <?php
  mysql_query('SET NAMES utf8');
  if(isset($_POST['addnews'])){
    for($i=0; $i<5; $i++){
      if($i>0){
        $dop="_".$i;
      }
      if(!empty($_FILES['filename'.$dop])){
        // Якщо поле вибору картинки не пусте - закидуємо її на сервер  
        $path="";
        // якщо треба загрузку файла то загружаєм   
        if(!empty($_FILES['filename']['tmp_name'])){
          // Пишем шлях до файлу   
          $path="/img/news/".date("YmdHis",time());
          // Перевіряєм чи файл не є скріптом PHP чи Perl, html, якщо є то перейменовуєм його в формат .txt
          $extentions=array("#\.php#is",
            "#\.phtml#is",
            "#\.php3#is",
            "#\.html#is",
            "#\.htm#is",
            "#\.hta#is",
            "#\.pl#is",
            "#\.xml#is",
            "#\.inc#is",
            "#\.shtml#is",
            "#\.xht#is",
            "#\.xhtml#is");
          // Витягуєм з імені файлу розширення  
          $ext=strrchr($_FILES['filename']['name'],".");
          $add=$ext;
          foreach($extentions AS $exten){
            if(preg_match($exten,$ext)){
              $add=".txt";
            }
          }
          $path .= $add;

          // Переміщуєм файл з тимчасової директорії сервера в
          if(copy($_FILES['filename']['tmp_name'],"../".$path)){
            // Видаляєм файл з тимчасової директорії   
            @unlink($_FILES['filename']['tmp_name']);
            // Змінюєм права доступу до файлу 
            chmod("../".$path,0644);
          }
        }else{
          links("Не вибраний файл для загрузки");
        }
      }else{
        echo 'нема фото №'.$dop;
      }
    }
    $hsl=mysql_query("INSERT INTO `news`.`news` (`id`, `name`, `body`, `putdate`, `url_pict`, `url_pict_1`, `url_pict_2`, `url_pict_3`, `url_pict_4`) VALUES ('', 
																				'".$_POST['name']."',
																				'".$_POST['body']."', 
																				'".$_POST['putdate']."',  
																				'".$_POST['url_pict']."', 
																				'".$_POST['url_pict_1']."',
																				'".$_POST['url_pict_2']."',
																				'".$_POST['url_pict_3']."',
																				'".$_POST['url_pict_4']."')");
    if($hsl){
      echo "<script>alert('Додано')</script>";
    }else{
      echo "<script>alert('Помилка заповнення')</script>";
    }
  }
  ?>
  <script>
				function reset_form () {
					document.getElementById("donation_form").reset();
				}
  </script>
  <div class="container">
   <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">	
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form_edit">	
     <p class="form_edit_name"> Додати новину:	 </p>
     <form enctype="multipart/form-data" id="donation_form" action="" method="post">
      <label class="form_salary_name"> Імя: * </label> <br><input type="text" name="name"><br>
      <label class="form_salary_name"> Текст: * </label> <br> <textarea name="body" cols="20" rows="1"></textarea><br>
      <label class="form_salary_name"> Дата : </label><br><input type="date" name="putdate"><br>
      <label class="form_salary_name"> Фото : </label>
<?php
for($i=0; $i<5; $i++){
  if($i>0){
    $dop="_".$i;
  }
  ?>
        <br><input size="70" type="file" name="filename<?=$dop?>">
        <?php
      }
      ?>
      <br>
      <input style="margin: 10px 0px;" class="btn btn-large btn-primary" type="submit" name="addnews" value="Додати">
      <input style="margin: 10px 0px;" class="btn btn-large btn-primary" type="button" onclick="reset_form()" value="Очистити">
     </form>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">	
    </div>
   </div>
  </div>
<?php
include '../util/footer.php';
?>


