<?php


if(isset($_POST['PK_codagend'])){

$PK_codagend_ = $_POST['PK_codagend'];
$explode = explode(',', $PK_codagend_);
$PK_codagenda =  $explode[0];
echo'<br>';
$PK_codrotavenda = $explode[1];
echo'<br>';
}





echo'
<center>
<p>Você está prestes a deletar um agendamento. Tem certeza que quer fazer isso?</P>
</center>
<form method="POST" id="form_enviar2">
<input type="hidden" id="PK_codagende" name="PK_codagende" value="'.$PK_codagenda.'"/>
<input type="hidden" id="PK_codrotave"  value="'.$PK_codrotavenda.'" name="PK_codrotave">
<center>
<br>
 <button type="submit" onclick="enviar2();
" name="excluir" class="btn btn-default" >Confirmar</button>  
</center>
';




?>
<script type="text/javascript">
function enviar2(){
    form=document.getElementById('form_enviar2');
    form.submit();
    form.action='gerar_rotag2.php';
}

</script> 