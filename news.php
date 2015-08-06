
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ifka</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/main.less" rel="stylesheet">
  <script type="text/javascript" src="js/less.js"></script>
  <link rel="icon" href="img/ico.ico" type="image/x-icon">
  <link rel="shortcut icon" href="img/ico.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  <link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" /> 
 </head>
 <body>
  <div class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
      <span class="sr-only">Відкрити меню</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="index.php"> ifka </a>
    </div>
    <div class="collapse navbar-collapse" id="responsive-menu">
     <ul class="nav navbar-nav">  
      <li><a href="new.php"><i class="fa fa-book fa-fw"></i>Новини</a></li>
      <li><a href="projects.php"><i class="fa fa-codepen fa-fw"></i>Проекти</a></li>
      <li><a href="project.php"><i class="fa fa-edit fa-fw"></i>Молодь і Влада </a></li>
      <li><a href="team.php"><i class="fa fa-group fa-fw"></i>Команда</a></li>
      <li><a href="photo.php"><i class="fa fa-picture-o fa-fw"></i>Фото</a></li>
      <li><a href="video.php"><i class="fa fa-video-camera fa-fw"></i>Відео</a></li>
      <li><a href="contacts.php"><i class="fa fa-phone fa-fw"></i>Контакти</a></li>
     </ul>
     <!-- Search -->

     <form class="form-wrapper" name="search" method="post" action="search.php">
      <input type="search" name="query" placeholder="Пошук" />
      <input class="btn btn-success" type="submit" value="Пошук" id="submit" /><br />
     </form>

     <!-- Search -->
    </div>
   </div>
  </div>
		<?php
		require_once("config.php");
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
				<div id="carousel" class="carousel slides " style="box-shadow: 0px 3px 11px rgba(0, 0, 0, 0.7);">
					<!-- Індикатор слайдів -->

					<div class="carousel-inner">
						<div class="item active">
							<?php
							if(trim($news['url_pict'])!=""&&trim($news['url_pict'])!="-"){
								$a=1;
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}else{
								echo	"<img class=imgnewssliders src='img/uk.jpg'>";
							}
							?>
						</div>
						<div class="item">
							<?php
							if(trim($news['url_pict_1'])!=""&&trim($news['url_pict_1'])!="-"){
								$a=1;
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict_1']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}else{
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}
							?>
						</div>
						<div class="item">
							<?php
							if(trim($news['url_pict_2'])!=""&&trim($news['url_pict_2'])!="-"){
								$a=1;
								if(isset($a)){
									$c=1;
									?>
									<img  class=imgnewssliders src=<?=$news['url_pict_2']?> >
									<div class=carousel-caption>
										<p class='namenewsslifers' ><?=$news['name']?></p>
									</div>
									<?php
								}
							}else{
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}
							?>
						</div>
						<div class="item">
							<?php
							if(trim($news['url_pict_3'])!=""&&trim($news['url_pict_3'])!="-"){
								$a=1;
								if(isset($a)){
									$d=1;
									?>
									<img  class=imgnewssliders src=<?=$news['url_pict_3']?> >
									<div class=carousel-caption>
										<p class='namenewsslifers' ><?=$news['name']?></p>
									</div>
									<?php
								}
							}else{
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict_1']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}
							?>
						</div>
						<div class="item">
							<?php
							if(trim($news['url_pict_4'])!=""&&trim($news['url_pict_4'])!="-"){
								$a=1;
								if(isset($a)){
									$e=1;
									?>
									<img  class=imgnewssliders src=<?=$news['url_pict_4']?> >
									<div class=carousel-caption>
										<p class='namenewsslifers' ><?=$news['name']?></p>
									</div>
									<?php
								}
							}else{
								?>
								<img  class=imgnewssliders src=<?=$news['url_pict']?> >
								<div class=carousel-caption>
									<p class='namenewsslifers' ><?=$news['name']?></p>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<!-- Перемикач слайда -->
					<?php
					if(isset($a)){
						?>
						<a href="#carousel" class="left carousel-control" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" > </span>
						</a>
						<a href="#carousel" class="right carousel-control" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" ></span>
						</a>
						<?php
					}
					?>
					<?php
					if(isset($a)){
						
					}else{
						unset($a);
					}
					if(isset($a)){
						echo	" <ol class='carousel-indicators'>";
						echo	" <li class='active' data-target='#carousel' data-slide-to='0'></li>";
						echo	" <li data-target='#carousel' data-slide-to='1'></li>";
						if(isset($c)){
							echo	" <li data-target='#carousel' data-slide-to='2'></li>";
							if(isset($d)){
								echo	" <li data-target='#carousel' data-slide-to='3'></li>";
								if(isset($e)){
									echo	" <li data-target='#carousel' data-slide-to='4'></li>";
								}
							}
						}
						echo	"</ol>";
					}
					?>
					<!-- Перемикач слайда -->
				</div>
				<div class="container">
					<div class="row">
						<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
							<p class='namenews' ><?=$news['name']?></p>
							<p style='text-align: center;'><?=($news['putdate'])?></p>
							<p class='textnews'><?=nl2br($news['body'])?></p>
						</div>
						<div class='container'>
							<div class='row'>
								<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
									<?php
									if(trim($news['url_pict'])!=""&&trim($news['url_pict'])!="-"){
										echo	"<a class='imgnews'	 href=".$news['url_pict'].">";
										echo	"<img class='imgnews' src=".$news['url_pict'].">";
										echo	"</a>";
									}
									?>
								</div>
								<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
									<?php
									if(trim($news['url_pict_1'])!=""&&trim($news['url_pict_1'])!="-"){
										echo	"<a class='imgnews' href=".$news['url_pict_1'].">";
										echo	"<img class='imgnews' src=".$news['url_pict_1'].">";
										echo	"</a>";
									}
									?>
								</div>
								<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
									<?php
									if(trim($news['url_pict_2'])!=""&&trim($news['url_pict_2'])!="-"){
										echo	"<a class='imgnews' href=".$news['url_pict_2'].">";
										echo	"<img class='imgnews' src=".$news['url_pict_2'].">";
										echo	"</a>";
									}
									?>
								</div>
							</div>
						</div>
						<div class='container'>
							<div class='row'>
								<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
									<?php
									if(trim($news['url_pict_3'])!=""&&trim($news['url_pict_3'])!="-"){
										echo	"<a class='imgnews' href=".$news['url_pict_3'].">";
										echo	"<img class='imgnews' src=".$news['url_pict_3'].">";
										echo	"</a>";
									}
									?>
								</div>
								<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
									<?php
									if(trim($news['url_pict_4'])!=""&&trim($news['url_pict_4'])!="-"){
										echo	"<a class='imgnews' href=".$news['url_pict_4'].">";
										echo	"<img class='imgnews' src=".$news['url_pict_4'].">";
										echo	"</a>";
									}
									?>
								</div>
							</div>
						</div>
						<div class='container'>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<p style='text-align: center;'><?=$news['putdate']?></p>
									<p class='namenews' ><?=$news['name']?></p>
								</div>
							</div>
							<?php
						}
					}
					?>

				</div>
			</div>
		</div>
		<?php
		include	'util/footer.php';
		?>
		