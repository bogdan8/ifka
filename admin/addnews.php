<?php

mysql_query('SET NAMES utf8');
if	(isset($_POST['addnews']))	{

				for	($i	=	0;	$i	<	5;	$i++)	{
								if	($i	>	0)	{
												$dop	=	"_"	.	$i;
								}
								// Якщо поле вибору картинки не пусте - закидуємо її на сервер  
								$path	=	"";
								// якщо треба загрузку файла то загружаєм   
								if	(!empty($_FILES['filename']['tmp_name']))	{
												// Пишем шлях до файлу   
												$path	=	"/img/news/"	.	date("YmdHis",	time());
												// Перевіряєм чи файл не є скріптом PHP чи Perl, html, якщо є то перейменовуєм його в формат .txt
												$extentions	=	array("#\.php#is",
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
												$ext	=	strrchr($_FILES['filename']['name'],	".");
												$add	=	$ext;
												foreach	($extentions	AS	$exten)	{
																if	(preg_match($exten,	$ext))
																				$add	=	".txt";
												}
												$path	.=	$add;

												// Переміщуєм файл з тимчасової директорії сервера в
												if	(copy($_FILES['filename'	]['tmp_name'],	"../"	.	$path))	{
																// Видаляєм файл з тимчасової директорії   
																@unlink($_FILES['filename'	]['tmp_name']);
																// Змінюєм права доступу до файлу 
																@chmod("../"	.	$path,	0644);
												}
								}	else	{
												links("Не вибраний файл для загрузки");
								}
				}

				$hsl	=	mysql_query("INSERT INTO `news`.`news` (`id`, `name`, `body`, `putdate`, `url_pict`, `url_pict_1`, `url_pict_2`, `url_pict_3`, `url_pict_4`) VALUES ('', 
																				'"	.	$_POST['name']	.	"',
																				'"	.	$_POST['body']	.	"', 
																				'"	.	$_POST['putdate']	.	"',  
																				'"	.	$_POST['url_pict']	.	"', 
																				'"	.	$_POST['url_pict_1']	.	"',
																				'"	.	$_POST['url_pict_2']	.	"',
																				'"	.	$_POST['url_pict_3']	.	"',
																				'"	.	$_POST['url_pict_4']	.	"')");
				if	($hsl)	{
								echo	"<script>alert('Додано')</script>";
				}	else	{
								echo	"<script>alert('Помилка заповнення')</script>";
				}
}

?>