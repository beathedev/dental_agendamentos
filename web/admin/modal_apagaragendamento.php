<?php
$PK_codagend = $_POST['PK_codagend'];



  echo '  
 <form method="POST" action="edit_agend_admin.php">
    <h5>Você está prestes a apagar este agendamento, deseja continuar?</h5>
    <br>
<input type="hidden" name="PK_codagend" value="'.$PK_codagend.'"/>

<input type="submit" class="btn btn-default" name="apaga_agend" value="Apagar"   >
</form>
';

?>