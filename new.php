<?php
include 'util/header.php';
?>
<?php
include 'util/sliders.php';
?>
        <div class="container">
            <div class="row">
                <?php
                Error_Reporting(E_ALL & ~E_NOTICE); 
                require_once("config.php");
                ?>
                <p class="news_name"></p>
                <?php
                $tot = mysql_query("SELECT count(*) FROM news WHERE hide='show' AND putdate <= NOW()");
                if ($tot)

                $query = "SELECT * FROM news 
                WHERE hide='show' AND putdate <= NOW()
                ORDER BY putdate DESC
                ";
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
                }
                ?>
              
             </div>
        </div>
     <?php
                include 'util/footer.php';
        ?>	