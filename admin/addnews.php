<?php	include	'headeradmin.php';?>
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


