<?php	include	'headeradmin.php';?>
 <div class="container" style="margin-top: 50px; text-align: center;">
  <div class="row">

			<p class="nameform">Додати фото:	 </p>
			<?php
			function	write_img_thumb($path,$file_name,$width,$height,$dst){
				if(preg_match("/\.gif/i",$file_name)){
					$image=imagecreatefromgif($path.$file_name);
					list($width_orig,$height_orig)=getimagesize($path.$file_name);
					$ratio_orig=$width_orig/$height_orig;
					if($width/$height>$ratio_orig){
						$width=$height*$ratio_orig;
					}else{
						$height=$width/$ratio_orig;
					}
					$image_p=imagecreatetruecolor($width,$height);
					imagecopyresampled($image_p,$image,0,0,0,0,$width,$height,$width_orig,$height_orig);
					if(file_exists($path.$dst)){
						$dst=random_string(5).$dst;
					}
					if(!preg_match('/[0-9a-zA-Z\.]+/',$dst)){
						$dst=random_string(5).'.gif';
					}
					imagegif($image_p,$path.$dst);
					imagedestroy($image);
					imagedestroy($image_p);
				}else{
					$image=imagecreatefromjpeg($path.$file_name);
					list($width_orig,$height_orig)=getimagesize($path.$file_name);
					$ratio_orig=$width_orig/$height_orig;
					if($width/$height>$ratio_orig){
						$width=$height*$ratio_orig;
					}else{
						$height=$width/$ratio_orig;
					}
					$image_p=imagecreatetruecolor($width,$height);
					imagecopyresampled($image_p,$image,0,0,0,0,$width,$height,$width_orig,$height_orig);
					if(file_exists($path.$dst)){
						$dst=random_string(5).$dst;
					}
					if(!preg_match('/[0-9a-zA-Z\.]+/',$dst)){
						$dst=random_string(5).'.jpg';
					}
					imagejpeg($image_p,$path.$dst);
					imagedestroy($image);
					imagedestroy($image_p);
				}
			}
			if(isset($_POST['log'])){
				$nm=$_POST['nm'];
				$ds=$_POST['dl'];
				$idcat=$_POST['cat'];
				foreach($_FILES['files']['tmp_name']	as	$key=>	$name_tmp){
					$name=date("Ymdgis").$_FILES['files']['name'][$key];
					$tmpnm=$_FILES['files']['tmp_name'][$key];
					$type=$_FILES['files']['type'][$key];
					$size=$_FILES['files']['size'][$key];
					$dir="../photo/".$name;
					$move=move_uploaded_file($tmpnm,$dir);	
					$image=$name;
					$movee = write_img_thumb('../photo/',$image,250,150,'thumb/'.$image);
					if($move){
						if($idcat>0){
							$hsl=mysql_query(
											"INSERT into `photo` VALUES ('', '$nm', '$ds', '$name', '$type', '$size','$idcat')");
							if($hsl){
								echo	"<script>alert('Добавлено')</script>";
							}else{
								echo	"<script>alert('Помилка бази данних')</script>";
							}
						}else{
							echo	"<script>alert('Невибрана категорія')</script>";
						}
					}else{
						echo	"<script>alert('Помилка папки')</script>";
					}
				}
			}
			/* if(empty($_POST['linksphoto'])){	
				 }else{
				 $nm=$_POST['nm'];
				 $ds=$_POST['dl'];
				 $idcat=$_POST['cat'];
				 $name=$_POST['linksphoto'];
				 if($idcat>0){
				 $hsl=mysql_query(
				 "INSERT into `photo` VALUES ('', '$nm', '$ds', '$name', '$type', '$size','$idcat')");
				 if($hsl){
				 echo	"<script>alert('Добавлено')</script>";
				 }else{
				 echo	"<script>alert('Помилка бази данних')</script>";
				 }
				 }else{
				 echo	"<script>alert('Невибрана категорія')</script>";
				 }
				 } */
			?>
			<form action="" method="POST" enctype="multipart/form-data">
				<table>
					<tr>
						<td style="margin-left: 50px;"><br>
							<label  class="nameform"> Фото: </label>
							<input type="file" name="files[]" />
						</td>
						<td></td>
					</tr>
					<tr>
						<td style="margin-left: 50px;"><br>
							<label class="nameform"> Імя: </label><br>
							<input type="text" name="nm" />
						</td>
						<td></td>
					</tr>
					<!--	
					<tr>
							<td style="margin-left: 50px;"><br>
								<label class="nameform"> Силка на фото: </label><br>
								<input type="text" name="linksphoto" />
							</td>
							<td></td>
						</tr>
					-->
					<tr>
						<td style="margin-left: 50px;"><br>
							<label class="nameform"> Опис: </label><br>
							<textarea rows="1" cols="20" name="dl" ></textarea>
						</td>
						<td></td>
					</tr>
					<tr>
						<td style="margin-left: 50px;"><br>
							<select name="cat">
								<option value="0" disabled selected>Без категорії</option>
								<?php
								$res=mysql_query('SELECT `id_cat`, `name_cat` FROM `category`');
								while($row=mysql_fetch_assoc($res)){
									?>
									<option value="<?=$row['id_cat']?>"><?=$row['name_cat']?></option>
									<?php
								}
								?>
							</select>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<p><br>
								<input class="btn btn-success" type="submit" name="log" value="Додати" />
							</p>
						</td>
						<td></td>
					</tr>
				</table>				
			</form>

  </div>  
	</div>
</div>

