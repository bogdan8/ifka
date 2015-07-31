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
	<div class="container" style="margin-top: 70px;">
		<?php
		if(!preg_match("|^[\d]*$|",$_GET['page']))
			puterror("Помилка при підключені до блоку новин");
		$page=$_GET['page'];
		if(empty($page))
			$page=1;
		$begin=($page-1)*$all_number_news;
		if(!preg_match("|^[\d]*$|",$_GET['id_news']))
			puterror("Помилка при підключені до блоку новин");
		if(isset($_GET['id_news'])){
			$query="SELECT * FROM `news` WHERE id_news=".$_GET['id_news'];
		}else{
			$query="SELECT id_news,
              name,
              body,
              DATE_FORMAT(putdate,'%d.%m.%Y') as putdate_format,
              url_pict,
              url_pict_1,
              url_pict_2,
              url_pict_3,
              url_pict_4,
              FROM `news`
              WHERE putdate <= NOW()
              LIMIT $begin, $all_number_news";
		}
		$new=mysql_query($query);
		if(!$new)
			puterror("Помилка при підключені до блоку новин");
		if(mysql_num_rows($new)>0){
			while($news=mysql_fetch_array($new)){
				?>
				<div class='row'>
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						<p style='text-align: center;'><?=($news['putdate'])?></p>
						<p class='namenews' ><?=$news['name']?></p>
					</div>
				</div>
				<?php
			}
		}
		?>

	</div>
	<?php
	include	'..util/footer.php';
	?>
		