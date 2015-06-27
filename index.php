<?php
include 'util/header.php';
?>
<?php
include 'util/sliders.php';
?>
        <div class="container">
            <div class="row">
              <?php
                Error_Reporting(0); 
                require_once("config.php");
                ?>
                <p class="news_name"></p>
                <?php
                // Провіряєм параметри page,  SQL-інєкція
            if(!preg_match("|^[\d]*$|",$_POST['page'])) puterror("Помилка при підключені до блоку новин");
            // Провіряєм зміну  $page, рівну порядковому номеру першої новини на сторінці
            $page = $_GET['page'];
            if(empty($page)) $page = 1;
            $begin = ($page - 1)*$all_number_news;

                $tot = mysql_query("SELECT count(*) FROM news WHERE putdate <= NOW()");
                if ($tot)
                $query = "SELECT * FROM news 
            WHERE putdate <= NOW()
                ORDER BY putdate DESC            		

            LIMIT $begin, $all_number_news";
                $new = mysql_query($query);
                if(!$new) puterror("Помилка при підключені до блоку новин");
                if(mysql_num_rows($new) > 0)
                {
            while($news = mysql_fetch_array($new))
                {
            echo "<p class=newsblockzag><b>".$news['name']."</b></p>";
            $pos = strpos(substr($news['body'],$numchar), " ");
            if(strlen($news['body'])>$numchar) $srttmpend = "...";
            else $strtmpend = "";
            echo "<p class=newsblock>".substr($news['body'], 0, $numchar+$pos).$srttmpend;
            echo "<br><a class='btn btn-success' href=news.php?id_news=".$news['id_news'].">Детальніше:</a></p>";
                }
                }// Сторінкова навігація
              $page_link = 4;
              $query = "SELECT COUNT(*) FROM news";
              $tot = mysql_query($query);

              $total = mysql_result($tot,0);
              $number = (int)($total/$all_number_news);
              if((float)($total/$all_number_news) - $number != 0) $number++;
              echo "<br><table><tr><td><p>";
              // Перевіряєм чи є силка зліва
              if($page - $page_link > 1)
              {
                echo "<a id=number_page href=$_SERVER[PHP_SELF]?page=1>[1-$all_number_news]</a>&nbsp;&nbsp;...&nbsp;";
                // Є
                for($i = $page - $page_link; $i<$page; $i++)
                {
                    echo "&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
                }
              }
              else
              {
                // Нема
                for($i = 1; $i<$page; $i++)
                {
                    echo "&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
                }
              }
              // Перевіряєм чи є силка зправа
              if($page + $page_link < $number)
              {
                // Є
                for($i = $page; $i<=$page + $page_link; $i++)
                {
                  if($page == $i)
                    echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]&nbsp;";
                  else
                    echo "&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
                }
                echo "&nbsp;...&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=$number>[".(($number - 1)*$all_number_news + 1)."-$total]</a>&nbsp;";
              }
              else
              {
                // Нема
                for($i = $page; $i<=$number; $i++)
                {
                  if($number == $i)
                  {
                    if($page == $i)
                      echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-$total]&nbsp;";
                    else
                      echo "&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-$total]</a>&nbsp;";
                  }
                  else
                  {
                    if($page == $i)
                      echo "&nbsp;[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]&nbsp;";
                    else
                      echo "&nbsp;<a id=number_page href=$_SERVER[PHP_SELF]?page=".$i.">[".(($i - 1)*$all_number_news + 1)."-".$i*$all_number_news."]</a>&nbsp;";
                  }
                }
              }
              echo "</td></tr></table>";
              ?>

             </div>
        </div>
        <?php
                include 'util/footer.php';
        ?>
     