
<?php

require_once("config.php");

?>

<?php

include	'util/header.php';

?>

<?php

include	'util/sliders.php';

?>

<div class="container">
				<div class="row" >
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
												<?php

// Провіряєм параметри page,  SQL-інєкція
												if	(!preg_match("|^[\d]*$|",	$_POST['page']))
																puterror("Помилка при підключені до блоку новин");
												$n	=	5;
												$tot	=	mysql_query("SELECT * FROM photo ORDER BY `id` DESC LIMIT $n ");

												if	($tot)
																$query	=	"SELECT * FROM photo ORDER BY `id` DESC LIMIT $n ";
												$new	=	mysql_query($query);
												if	(!$new)
																puterror("Помилка при підключені до блоку новин ");
												if	(mysql_num_rows($new)	>	0)	{

																// Провіряєм параметри page,  SQL-інєкція
																$page	=	$_GET['page'];
																if	(empty($page))
																				$page	=	1;
																$begin	=	($page	-	1)	*	$all_number_photo;

																$tot	=	mysql_query("SELECT count(*) FROM photo ");
																if	($tot)
																				$query	=	"SELECT * FROM photo 
																LIMIT $begin, $all_number_photo";
																$new	=	mysql_query($query);
																if	(!$new)
																				puterror("Помилка при підключені до блоку новин");
																if	(mysql_num_rows($new)	>	0)	{
																				while	($photo	=	mysql_fetch_array($new))	{
																								if	(trim($photo['file'])	!=	""	&&	trim($photo['file'])	!=	"-")
																												

																												?>
																								<div class="phototable">
																												<a class="fancyimage" href="/img/photo/<?php	echo	$photo['file']	?>" >
																																<img  class="photo" src="/img/photo/<?php	echo	$photo['file']	?>" />
																												</a>
																												<div class="descphototable">
																																<p class="foto_name" style="box-shadow: 0px 0px 5px;">Назва: <?php	echo	'<br>'	.	$photo['name'];	?></p>
																																<p class="foto_name">Опис: <?php	echo	'<br>'	.	$photo['desc'];	?></p>

																												</div>
																								</div>
																								<?php

																				}
																}// Сторінкова навігація
																$page_link	=	4;
																$query	=	"SELECT COUNT(*) FROM photo";
																$tot	=	mysql_query($query);

																$total	=	mysql_result($tot,	0);
																$number	=	(int)	($total	/	$all_number_photo);
																if	((float)	($total	/	$all_number_photo)	-	$number	!=	0)
																				$number++;
																echo	"<br><table><tr><td><p>";
																// Перевіряєм чи є силка зліва
																if	($page	-	$page_link	>	1)	{
																				echo	"<a id=number_page href=$_SERVER[PHP_SELF]?page=1>[1-$all_number_photo]</a>&nbsp;&nbsp;...&nbsp;";
																				// Є
																				for	($i	=	$page	-	$page_link;	$i	<	$page;	$i++)	{
																								echo	"&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page="	.	$i	.	">["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]</a>&nbsp;";
																				}
																}	else	{
																				// Нема
																				for	($i	=	1;	$i	<	$page;	$i++)	{
																								echo	"&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page="	.	$i	.	">["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]</a>&nbsp;";
																				}
																}
																// Перевіряєм чи є силка зправа
																if	($page	+	$page_link	<	$number)	{
																				// Є
																				for	($i	=	$page;	$i	<=	$page	+	$page_link;	$i++)	{
																								if	($page	==	$i)
																												echo	"&nbsp;["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]&nbsp;";
																								else
																												echo	"&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page="	.	$i	.	">["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]</a>&nbsp;";
																				}
																				echo	"&nbsp;...&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=$number>["	.	(($number	-	1)	*	$all_number_photo	+	1)	.	"-$total]</a>&nbsp;";
																}
																else	{
																				// Нема
																				for	($i	=	$page;	$i	<=	$number;	$i++)	{
																								if	($number	==	$i)	{
																												if	($page	==	$i)
																																echo	"&nbsp;["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-$total]&nbsp;";
																												else
																																echo	"&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page="	.	$i	.	">["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-$total]</a>&nbsp;";
																								}
																								else	{
																												if	($page	==	$i)
																																echo	"&nbsp;["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]&nbsp;";
																												else
																																echo	"&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page="	.	$i	.	">["	.	(($i	-	1)	*	$all_number_photo	+	1)	.	"-"	.	$i	*	$all_number_photo	.	"]</a>&nbsp;";
																								}
																				}
																}
																echo	"</td></tr></table>";
												}// Сторінкова навігація

												?>
								</div>
				</div>
</div>
<?php

include	'util/footer.php';

?>
		