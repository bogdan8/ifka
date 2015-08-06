<?php	include	'headeradmin.php';?>
 <div class="container" style="margin-top: 50px; text-align: center;">
  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="nameform">Додати відео:	 </p>
    <?php
    if(isset($_POST['addvideo'])){
      $name=$_POST['name'];
      $linkvideo=$_POST['linkvideo'];
      $hsl=mysql_query(
          "INSERT into `video` VALUES ('', '$name', '$linkvideo')");
      if($hsl){
        echo "<script>alert('Додано')</script>";
      }else{
        echo "<script>alert('Помилка')</script>";
      }
    }
    ?>

    <form action="" method="POST">
     <table>
      <tr>
       <td style="margin-left: 50px;">
        <br><label  class="nameform"> Імя: </label>
        <br><input type="text" name="name" />
       </td>
       <td></td>
      </tr>
      <tr>
       <td style="margin-left: 50px;">
        <br><label  class="nameform"> Посилання на відео: </label>
        <br><textarea rows="1" cols="20" name="linkvideo" ></textarea>
       </td>
       <td></td>
      </tr>
      <tr>
       <td style="margin-left: 50px;">
        <br><input class="btn btn-success" type="submit" name="addvideo" value="Додати" />
       </td>
       <td></td>
      </tr>
     </table>
    </form>
   </div>
  </div>
 </div>

