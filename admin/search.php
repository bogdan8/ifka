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

																				<li><a href="allnews.php"><i class="fa fa-book fa-fw"></i>Новини</a></li>
																				<li><a href="addphoto.php"><i class="fa fa-picture-o fa-fw"></i>Фото</a></li>
																				<li><a href="addvideo.php"><i class="fa fa-video-camera fa-fw"></i>Відео</a></li>
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
				
				<div class="container" style="margin-top: 50px;">
								<div class="row">
												<?php

												function	connectDB()	{
																define('DB_HOST',	'localhost');
																define('DB_USER',	'root');
																define('DB_PASS',	'70sunogo');
																define('DB_NAME',	'news');

																//Пробуєм зєднатись з базою данних
																$dbconn	=	mysql_connect(DB_HOST,	DB_USER,	DB_PASS)
																or	die("Помилка зєднання з базою даних! "	.	mysql_error());
																//і вибираєм таблиці
																mysql_select_db(DB_NAME);
																// Встановлюєм кодування
																mysql_query('SET NAMES utf8');
																//Повертаєм дескриптор зєднання
																return	$dbconn;

												}

												/* Закриваєм зєднання з базлю данних */

												function	closeDB($dbconn)	{
																mysql_close($dbconn);

												}

												/* Обробляєм пошуковий запит */

												function	search($query)	{
																$text	=	'';

																// Проводим фільтрацію даних
																$query	=	trim($query);																					// обрізаєм проблему з спецсимволами
																$query	=	strip_tags($query);															// Видаляєм HTML та PHP теги
																$query	=	mysql_real_escape_string($query);	// Екрануєм спеціальні символи
																//Пошуковий запит не пустий?
																if	(!empty($query))	{
																				if	(strlen($query)	<	4)	{
																								$text	=	'<p>короткий пошуковий запит.</p>';
																				}	elseif	(strlen($query)	>	128)	{
																								$text	=	'<p>задовгий пошуковий запит.</p>';
																				}	else	{
																								//Формуєм рядок пошукового запиту 
																								$sql	=	"SELECT * FROM news . news WHERE `name` LIKE '%$query%'";
																								// та виконуємо його
																								$result	=	mysql_query($sql);
																								// Оприділяєм кількість найдених символів
																								$num	=	mysql_num_rows($result);


																								$array	=	mysql_fetch_array($result);

																								//Якщо число збіги (строк результату запиту ) більше 0 
																								if	($num	>	0)	{

																												//Получаємо ассоціативний массив
																												$row	=	mysql_fetch_assoc($result);
																												//та починаєм формувати рядок пошукової видачі
																												$text	.=	'<p style="float: left;">По вашому запиту:  <strong>'	.	'</p>'	.	'<p style="float: left;">'	.	$query	.	'</strong>'	.	' знайдено '	.	$num	.	' збігів:</p>';
																												echo	"<table border='0px' width='100%' ><tr>";
																												echo	"<td width='50%'> <p><b>"	.	$array['name']	.	"</b></p> </td>";
																												echo	"<td width='20%'> </td>";
																												echo	"<td width='30%'> <a class='btn btn-success' href=news.php?id_news="	.	$array['id_news']	.	">Текст:</a></p> </td>";
																												echo	"</tr></table>";


																												do	{
																																if	($num	<=	1)	{
																																				break;
																																}	else	{

																																				echo	"<table border='0px' width='100%' ><tr>";
																																				echo	"<td width='50%'> <p><b>"	.	$row['name']	.	"</b></p> </td>";
																																				echo	"<td width='20%'> </td>";
																																				echo	"<td width='30%'> <a class='btn btn-success' href=news.php?id_news="	.	$row['id_news']	.	">Текст:</a></p> </td>";
																																				echo	"</tr></table>";
																																}
																												}	while	($row	=	mysql_fetch_assoc($result));
																								}	else	{
																												// Знайти збіги невдалось 
																												$text	=	'<p>По вашому запиті нічого не знайдено.</p>';
																								}
																				}
																}	else	{
																				$text	=	'<p>Заданий порожній пошуковий запит.</p>';
																}
																//Повертаєм сформованую рядок пошукової видачі
																return	$text;

												}

												///////////// Сам скріпт обробки ///////////////
												if	(isset($_POST['query']))	{
																// Відкриваєм зєднання з базою даних
																$connect	=	connectDB();
																$search_result	=	search($_POST['query']);
																echo	$search_result;
																// Закриваєм зєднання з базою данних
																closeDB($connect);
												}

												?>

								</div>
				</div>
<?php

include	'util/footer.php';

?>
			
