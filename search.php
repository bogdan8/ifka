<?php
include 'util/header.php';
?>
<?php
include 'util/sliders.php';
?>
<div class="container">
 <div class="row">
  <?php
  function connectDB(){
    define('DB_HOST','mysql.hostinger.com.ua');
    define('DB_USER','u215896329_ak');
    define('DB_PASS','70sunogo');
    define('DB_NAME','u215896329_ak');

    //Пробуєм зєднатись з базою данних
    $dbconn=mysql_connect(DB_HOST,DB_USER,DB_PASS)
        or die("Помилка зєднання з базою даних! ".mysql_error());
    //і вибираєм таблиці
    mysql_select_db(DB_NAME);
    // Встановлюєм кодування
    mysql_query('SET NAMES utf8');
    //Повертаєм дескриптор зєднання
    return $dbconn;
  }
  /* Закриваєм зєднання з базлю данних */
  function closeDB($dbconn){
    mysql_close($dbconn);
  }
  /* Обробляєм пошуковий запит */
  function search($query){
    $text='';

    // Проводим фільтрацію даних
    $query=trim($query);                     // обрізаєм проблему з спецсимволами
    $query=strip_tags($query);               // Видаляєм HTML та PHP теги
    $query=mysql_real_escape_string($query); // Екрануєм спеціальні символи
    //Пошуковий запит не пустий?
    if(!empty($query)){
      if(strlen($query)<4){
        $text='<p>Короткий пошуковий запит.</p>';
      }elseif(strlen($query)>128){
        $text='<p>Задовгий пошуковий запит.</p>';
      }else{
        //Формуєм рядок пошукового запиту 
        $sql="SELECT * FROM news WHERE `name` LIKE '%$query%'";
        // та виконуємо його
        $result=mysql_query($sql);
        // визначаєм кількість найдених символів
        $num=mysql_num_rows($result);
        $array=mysql_fetch_array($result);
        //Якщо число збігається (рядок результату запиту ) більше 0 
        if($num>0){

          //Отримаєм ассоціативний массив
          $row=mysql_fetch_assoc($result);
          //та починаєм формувати рядок пошукової видачі
           $text .= '<p style="float: left;">По вашому запиту:  <strong>'.' '.'</p>'.'<p style="float: left;">'.$query.'</strong>'.' знайдено '.$num.' збігів:</p>';
          ?>
          <table border='0px' width='100%' ><tr>
          <td width='50%'> <p><b>"<?=$array['name']?>"</b></p> </td>
          <td width='20%'> </td>
          <td width='30%'> <?= '<a class="btn btn-success" href=news.php?id_news='.$array["id_news"].' >Текст:</a>'?></p></td>
          </tr></table>
          <?php
          do{
            if($num<=1){
              break;
            }else{
              ?>
              <table border='0px' width='100%' ><tr>
              <td width='50%'> <p><b><?=$row['name']?></b></p> </td>
              <td width='20%'> </td>
              <td width='30%'> <?= '<a class="btn btn-success" href=news.php?id_news='.$row["id_news"].'>Текст:</a>'?></p></td>
              </tr></table>
            <?php
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
    return $text;
  }
  ///////////// Сам скріпт обробки ///////////////
  if(isset($_POST['query'])){
    // Відкриваєм зєднання з базою даних
    $connect=connectDB();
    $search_result=search($_POST['query']);
    echo $search_result;
    // Закриваєм зєднання з базою данних
    closeDB($connect);
  }
  ?>

 </div>
</div>
<?php
include 'util/footer.php';
?>
			
