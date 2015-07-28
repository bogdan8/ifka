<?php
Error_Reporting(E_ALL & ~E_NOTICE); 

  // Імя сервера бази данних
  $dblocation = "localhost";
  // Імя бази данних, на хостінгу або локальній машині
  $dbname = "news";
  // Імя користувача бази данних
  $dbuser = "root";
  // Пароль
  $dbpasswd = "70sunogo";
  // Кількість новин,Показує в анонсі
  $pnumber = 10;
  // Кількість символів в одному рядку новин
  $numchar = 400;
  // Кількість новин, виводим їх на сторінку
  // Всі новини
  $number_photo	=	4;
  $all_number_news = 10;
	$all_number_photo = 50;
  // Версія Web-додатку
  $version = "2.0.3";
  

  // Зєднання з сервером бази даних
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$dbcnx) ;
  // Вибираєм базу даних
  if (!@mysql_select_db($dbname,$dbcnx)) ;


  
  // Визначаєм версію сервера
  $query = "SELECT VERSION()";
  $ver = mysql_query($query);
				if(!$ver) {exit("Помилка при визначені версії MySQL-сервера");}
  $version = mysql_result($ver, 0);
  list($major, $minor) = explode(".", $version);
  // Якщо версія вище 4.1 повідомляєм серверу що будем робити з 
  // кодуванням cp1251
  $ver = $major.".".$minor;
  if((float)$ver >= 4.1)
  {
   	mysql_query('SET NAMES utf8');
  }

  // Невелика функція яка виводить повідомлення про помилку
  // в звязку помилки запиту до бази даних
  function puterror($message)
  {
    exit("<p>$message</p>");
  }
?>