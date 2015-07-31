<?php
include	'../config.php';
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
 <div class="container" style="margin-top: 70px;">
		<?php
		// Провіряєм параметри page,  SQL-інєкція
		if(!preg_match("|^[\d]*$|",$_POST['page']))
			puterror("Помилка при підключені до блоку новин");
		// Провіряєм зміну  $page, рівну порядковому номеру першої новини на сторінці
		$page=$_GET['page'];
		if(empty($page))
			$page=1;
		$begin=($page-1)*$all_number_news;
		$tot=mysql_query("SELECT count(*) FROM news WHERE putdate <= NOW()");
		if($tot)
			$query="SELECT * FROM news 
            WHERE putdate <= NOW()
                ORDER BY putdate DESC            		

            LIMIT $begin, $all_number_news";
		$new=mysql_query($query);
		if(!$new)
			puterror("Помилка при підключені до блоку новин");
		if(mysql_num_rows($new)>0){
			while($news=mysql_fetch_array($new)){
				echo	"<p class=newsblockzag><b>".$news['name']."</b></p>";
				$pos=strpos(substr($news['body'],$numchar)," ");
				if(strlen($news['body'])>$numchar)
					$srttmpend="...";
				else
					$strtmpend="";
				echo	"<p class=newsblock>".substr($news['body'],0,$numchar+$pos).$srttmpend;
				echo	"<br><a class='btn btn-success' href=news.php?id_news=".$news['id_news'].">Детальніше:</a></p>";
			}
		}
		// Сторінкова навігація
		$page_link=4;
		$query="SELECT COUNT(*) FROM news";
		$tot=mysql_query($query);

		$total=mysql_result($tot,0);
		$number=(int)($total/$all_number_news);
		if((float)($total/$all_number_news)-$number!=0)
			$number++;
		echo	"<br><table><tr><td><p>";
		// Перевіряєм чи є силка зліва
		if($page-$page_link>1){
			echo	"<a id_news=number_page href=$_SERVER[PHP_SELF]?page=1>[1-$all_number_news]</a>&nbsp;&nbsp;...&nbsp;";
			// Є
			for($i=$page-$page_link;	$i<$page;	$i++){
				echo	"&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]</a>&nbsp;";
			}
		}else{
			// Нема
			for($i=1;	$i<$page;	$i++){
				echo	"&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]</a>&nbsp;";
			}
		}
		// Перевіряєм чи є силка зправа
		if($page+$page_link<$number){
			// Є
			for($i=$page;	$i<=$page+$page_link;	$i++){
				if($page==$i)
					echo	"&nbsp;[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]&nbsp;";
				else
					echo	"&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]</a>&nbsp;";
			}
			echo	"&nbsp;...&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=$number>[".(($number-1)*$all_number_news+1)."-$total]</a>&nbsp;";
		}
		else{
			// Нема
			for($i=$page;	$i<=$number;	$i++){
				if($number==$i){
					if($page==$i)
						echo	"&nbsp;[".(($i-1)*$all_number_news+1)."-$total]&nbsp;";
					else
						echo	"&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i-1)*$all_number_news+1)."-$total]</a>&nbsp;";
				}
				else{
					if($page==$i)
						echo	"&nbsp;[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]&nbsp;";
					else
						echo	"&nbsp;<a id_news=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i-1)*$all_number_news+1)."-".$i*$all_number_news."]</a>&nbsp;";
				}
			}
		}
		echo	"</td></tr></table>";
		?>

 </div>
</div>
<?php
include	'../util/footer.php';
?>
     