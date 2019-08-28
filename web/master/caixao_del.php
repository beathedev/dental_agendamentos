<?php
require_once("../conexao.php");
$PK_codagend = $_POST['PK_codagend'];
$explode = explode(',', $PK_codagend);
 $PK_codagend =  $explode[0];
 $FK_codrotav =  $explode[1];
 $dataentrega =  $explode[2];




$select4 = mysqli_query($conexao, "SELECT * from agend where PK_codagend='$PK_codagend'");
$atr = mysqli_num_rows($select4);

while ($dados = mysqli_fetch_assoc($select4)){
$nome_cliente = $dados['cliente'];
$cod_vendedor = $dados['FK_coduser'];
}

$select5 = mysqli_query($conexao, "SELECT * FROM usuario WHERE PK_coduser='$cod_vendedor'");
while ($dados5 = mysqli_fetch_assoc($select5)){
$nome_vendedor = $dados5['username'];
}





  echo '  
 <form method="POST" action="caixao.php">
    <h5>Você está prestes a apagar este caixão, deseja continuar?</h5>
    <br>
<input type="hidden" name="nome_cliente" value="'.$nome_cliente.'"/>
<input type="hidden" name="nome_vendedor" value="'.$nome_vendedor.'"/>
<input type="hidden" name="PK_codagend" value="'.$PK_codagend.'"/>
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden" name="dataentrega" value="'.$dataentrega.'">
<input type="submit" class="btn btn-default" name="apaga" value="Apagar"   >
</form>
';


?>