<?php	include	'headeradmin.php';?>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<?php
			function	connectDB(){
				define('DB_HOST','mysql.hostinger.com.ua');
				define('DB_USER','u215896329_ak');
				define('DB_PASS','70sunogo');
				define('DB_NAME','u215896329_ak');

				//Пробуєм зєднатись з базою данних
				$dbconn=mysql_connect(DB_HOST,DB_USER,DB_PASS)
								or	die("Помилка зєднання з базою даних! ".mysql_error());
				//і вибираєм таблиці
				mysql_select_db(DB_NAME);
				// Встановлюєм кодування
				mysql_query('SET NAMES utf8');
				//Повертаєм дескриптор зєднання
				return	$dbconn;
			}
			/* Закриваєм зєднання з базлю данних */
			function	closeDB($dbconn){
				mysql_close($dbconn);
			}
			/* Обробляєм пошуковий запит */
			function	search($query){
				$text='';

				// Проводим фільтрацію даних
				$query=trim($query);																					// обрізаєм проблему з спецсимволами
				$query=strip_tags($query);															// Видаляєм HTML та PHP теги
				$query=mysql_real_escape_string($query);	// Екрануєм спеціальні символи
				//Пошуковий запит не пустий?
				if(!empty($query)){
					if(strlen($query)<4){
						$text='<p>короткий пошуковий запит.</p>';
					}elseif(strlen($query)>128){
						$text='<p>задовгий пошуковий запит.</p>';
					}else{
						//Формуєм рядок пошукового запиту 
						$sql="SELECT * FROM news WHERE `name` LIKE '%$query%'";
						// та виконуємо його
						$result=mysql_query($sql);
						// Оприділяєм кількість найдених символів
						$num=mysql_num_rows($result);


						$array=mysql_fetch_array($result);

						//Якщо число збіги (строк результату запиту ) більше 0 
						if($num>0){

							//Получаємо ассоціативний массив
							$row=mysql_fetch_assoc($result);
							//та починаєм формувати рядок пошукової видачі
							$text	.=	'<p style="float: left;">По вашому запиту:  <strong>'.'</p>'.'<p style="float: left;">'.$query.'</strong>'.' знайдено '.$num.' збігів:</p>';
							echo	"<table border='0px' width='100%' ><tr>";
							echo	"<td width='50%'> <p><b>".$array['name']."</b></p> </td>";
							echo	"<td width='20%'> </td>";
							echo	"<td width='30%'> <a class='btn btn-success' href=index.php?id_news=".$array['id_news'].">Текст:</a></p> </td>";
							echo	"</tr></table>";


							do{
								if($num<=1){
									break;
								}else{

									echo	"<table border='0px' width='100%' ><tr>";
									echo	"<td width='50%'> <p><b>".$row['name']."</b></p> </td>";
									echo	"<td width='20%'> </td>";
									echo	"<td width='30%'> <a class='btn btn-success' href=index.php?id_news=".$row['id_news'].">Текст:</a></p> </td>";
									echo	"</tr></table>";
								}
							}while($row=mysql_fetch_assoc($result));
						}else{
							// Знайти збіги невдалось 
							$text='<p>По вашому запиті нічого не знайдено.</p>';
						}
					}
				}else{
					$text='<p>Заданий порожній пошуковий запит.</p>';
				}
				//Повертаєм сформованую рядок пошукової видачі
				return	$text;
			}
			///////////// Сам скріпт обробки ///////////////
			if(isset($_POST['query'])){
				// Відкриваєм зєднання з базою даних
				$connect=connectDB();
				$search_result=search($_POST['query']);
				echo	$search_result;
				// Закриваєм зєднання з базою данних
				closeDB($connect);
			}
			?>

		</div>
	</div>
	<?php
	include	'../util/footer.php';
	?>
			
