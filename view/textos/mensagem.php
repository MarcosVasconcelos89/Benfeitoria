<!-- includes the start of the div and the message from the DAO file -->

<div class="container">
<?php
if(isset($_GET['msg'])){
    $mensagem = base64_decode($_GET['msg']);
?>


  <div class="panel panel-info">
      <div class="panel-heading"><?php echo $mensagem;?></div>
   </div>
   <?php 
}
?>