
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ifka</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
		<link rel="icon" href="img/ico.ico" type="image/x-icon">
		<link rel="shortcut icon" href="img/ico.ico" type="image/x-icon">
		<link rel="stylesheet/less" href="css/main.less" />
		<script type="text/javascript" src="js/less.js"></script>
		<link rel="stylesheet" type="text/css" href="fancybox/scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
		<link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" /> 
	</head>
	<body>
		<div class="foncolor navbar navbar-inverse navbar-fixed-top">
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
						<input  type="search" name="query" placeholder="Пошук" />
						<input class="btn btn-success" type="submit" value="Пошук" id="submit" /><br />
					</form>

					<!-- Search -->
				</div>
			</div>
		</div>