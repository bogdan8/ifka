<?php	include	'../config.php';?>
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
		<?php
		mysql_query('SET NAMES utf8');
		if(isset($_POST['addnews'])){
			$hsl=mysql_query("INSERT INTO `news` (`id_news`, `name`, `body`, `putdate`, `url_pict`, `url_pict_1`, `url_pict_2`, `url_pict_3`, `url_pict_4`) VALUES ('', 
                '".$_POST['name']."',
                '".$_POST['body']."', 
                '".$_POST['putdate']."',  
                '".$_POST['namephoto']."',
                '".$_POST['namephoto_1']."',
                '".$_POST['namephoto_2']."',
                '".$_POST['namephoto_3']."',
                '".$_POST['namephoto_4']."')");


			if($hsl){
				echo	"<script>alert('Додано')</script>";
			}else{
				echo	"<script>alert('Помилка заповнення')</script>";
			}
		}
		?>
  <script>
			function reset_form () {
				document.getElementById("donation_form").reset();
			}
  </script>
		<div class="row">

			<p class="nameform"> Додати новину:	 </p>
			<form enctype="multipart/form-data" id="donation_form" action="" method="post">
				<label class="nameform"> Імя: * </label> <br><input type="text" name="name"><br>
				<label class="nameform"> Текст: * </label> <br> <textarea name="body" cols="20" rows="1"></textarea><br>
				<label class="nameform"> Дата : </label><br><input type="date" name="putdate"><br>
				<label class="nameform"> Фото : </label> <br><input type="text" name="namephoto"><br>
				<label class="nameform"> Фото1 : </label> <br><input type="text" name="namephoto_1"><br>
				<label class="nameform"> Фото2 : </label> <br><input type="text" name="namephoto_2"><br>
				<label class="nameform"> Фото3 : </label> <br><input type="text" name="namephoto_3"><br>
				<label class="nameform"> Фото4 : </label> <br><input type="text" name="namephoto_4"><br>
				<input style="margin: 10px 0px;" class="btn btn-success" type="submit" name="addnews" value="Додати">
				<input style="margin: 10px 0px;" class="btn btn-success" type="button" onclick="reset_form()" value="Очистити">
			</form>
		</div>
	</div>

	<?php
	include	'../util/footer.php';
	?>


