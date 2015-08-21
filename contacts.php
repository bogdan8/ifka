<?php

require_once("config.php");

?>
<?php

include	'util/header.php';

?>
<?php

include	'util/sliders.php';

?>
<?php

mysql_query('SET NAMES utf8');
if	(isset($_POST['log']))	{
				//pr($_POST['log']);				die();
				if	(!empty($_POST['name_contacts']))	{
								if	(!empty($_POST['text_contacts']))	{
												$hsl	=	mysql_query("INSERT INTO `news`.`contacts` VALUES ('', 
																				'"	.	$_POST['name_contacts']	.	"',
																				'"	.	$_POST['email_contacts']	.	"',
																				'"	.	$_POST['text_contacts']	.	"',
																				'"	.	$_POST['date_contacts']	.	"')");
												if	($hsl)	{
																echo	"<script>alert('Дякуєм за коментар ')</script>";
												}	else	{
																echo	"<script>alert('Помилка заповнення')</script>";
												}
								}	else	{
												"<script>alert('Ви неввели тексе')</script>";
								}
				}	else	{
								echo	"<script>alert('Ви неввели імя')</script>";
				}
}

?>
<script>
				function reset_form() {
								document.getElementById("donation_form").reset();
				}
</script>
<div class="container">
				<div class="row">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">	
								</div>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form_edit">	
												<p class="form_edit_name"> Інформаія про нас:	 </p>
												<form id="donation_form" action="">
																<label class="form_salary_name"> Імя: * </label> <br>
																<label class="form_salary_name"> Прізвище: * </label> <br>
																<label class="form_salary_name"> Країна: </label> <br>
																<label class="form_salary_name"> Місто: </label> <br>
																<label class="form_salary_name"> Email: * </label> <br>
																<label class="form_salary_name"> Дата народження приклад: </label><br>
																<label class="form_salary_name"> Мобільний: * </label><br>
																<label class="form_salary_name"> Номера фото які зроблені: * </label><br>
																<label class="form_salary_name"> Номер картки: * </label><br>
																<a class="btn btn-success" href='#' data-toggle='modal' data-target='#basicModal'>Звязатись з нами</a>
												</form>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">	
								</div>
				</div>

</div>

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog">
				<div class="modal-dialog">
								<div class="modal-content">
												<div class="modal-header"><button class="close" type="button" data-dismiss="modal">Х</button>
																<h4 class="modal-title" id="myModalLabel" >Напишіть нам і ми все виправим)</h4>
												</div>
												<div class="modal-body">
																<div class="container " >

																				<form id="donation_form" action="" method="post">
																								<label class="form_salary_name"> Імя: * </label> <br><input type="text" name="name_contacts"><br>
																								<label class="form_salary_name"> Email:  </label> <br><input type="email" name="email_contacts"><br>
																								<label class="form_salary_name"> Текст: * 	<br><textarea rows="10" cols="30" name="text_contacts" ></textarea><br>
																								<label class="form_salary_name"> Дата : </label><br><input type="date" name="date_contacts"><br>
																								<input style="margin: 10px 0px;" class="btn btn-success" type="submit" name="log" value="Надіслати">
																								<input style="margin: 10px 0px;" class="btn btn-success" type="button" onclick="reset_form()" value="Очистити">
																				</form>

																</div>
												</div>
								</div>
				</div>
</div>


								<?php

								include	'util/footer.php';

								?>
		