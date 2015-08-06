<?php	include	'headeradmin.php';?>
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
		