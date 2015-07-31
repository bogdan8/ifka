<?php
include	'config.php';
include	'util/header.php';
include	'util/sliders.php';
?>

<div class="container">
 <div class="row">

		<?php
		$query="SELECT * FROM  `category` ";
		$new=mysql_query($query);
		if(!$new)
			puterror("Помилка при підключені до блоку новин");

		if(mysql_num_rows($new)>0){
			while($photo=mysql_fetch_array($new)){
				$id_cat=$photo['id_cat'];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-top: 50px;">
					<div class="photoconteiner">
						<?php
						$showphotoque="SELECT * FROM  `photo` WHERE id_cat = $id_cat LIMIT $number_photo  ";
						$showphotoarr=mysql_query($showphotoque);
						if(mysql_num_rows($new)>0){
							while($showphoto=mysql_fetch_array($showphotoarr)){
								if(trim($showphoto['file'])!=""&&trim($showphoto['file'])!="-")
									
									?>
								<div class="modal fade" id="all<?=$id_cat?>" tabindex="-1" role="dialog">
									<div class="modal-dialog" style="width: 80%;">
										<div class="modal-content">
											<div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
												<p class="form_edit_name"> Всі фото	 </p>
											</div>
											<div class="modal-body">
												<?php
												$modalphoto="SELECT * FROM  `photo` WHERE id_cat = $id_cat ORDER BY `id` ";
												$allphoto=mysql_query($modalphoto);
												if(mysql_num_rows($allphoto)>0){
													while($modalphotoall=mysql_fetch_array($allphoto)){
														?>
														<a class="fancyimage" href="/photo/<?php	echo	$modalphotoall['file']?>" >
															<img  class="modalphoto" src="/photo/<?php	echo	$modalphotoall['file']?>" />
														</a>
														<?php
													}
												}
												?>
											</div>
										</div>
									</div>
								</div>
								<a class="fancyimage" href="/photo/<?=$showphoto['file']?>" >
									<img  class="photo" src="/photo/<?=$showphoto['file']?>" />
								</a>
								<?php
							}
						}
						?>
						<p class="namephoto" ><?=$photo['name_cat']." :";?></p>
						<a style="margin-bottom: 10px;" href='#' data-toggle='modal' class="btn btn-success" data-target='#all<?=$id_cat?>'>Переглянути</a>
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


