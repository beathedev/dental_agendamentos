<?php
require_once("../conexao.php");
$PK_codagend = $_POST['PK_codagend'];
$explode = explode(',', $PK_codagend);
$PK_codagend =  $explode[0];
$FK_codrotav =  $explode[1];
$dataentrega =  $explode[2];




  echo '  
  <form method="POST" action="caixao.php">
    <h5>Você está prestes a apagar todos os caixoes, deseja continuar?</h5>
    <br>
<input type="hidden"  name="PK_codagend" value="'.$PK_codagend.'"/>
<input type="hidden"   value="'.$FK_codrotav.'" name="FK_codrotav">
<input type="hidden"   value="'.$dataentrega.'" name="dataentrega2">
<input type="submit" value="Apagar"  name="apagar_tudo" class="btn btn-default">
</form>
';


?>