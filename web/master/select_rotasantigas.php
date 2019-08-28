<html>
<?php  

ob_start();
session_start();
    include_once("../conexao.php");

 if(isset($_POST["PK_codrotav"]))
 {  


$PK_codrotav = $_POST['PK_codrotav'];
$explode = explode(',', $PK_codrotav);




// ECHO $explode;

$PK_codrotav_ =  $explode[0];
echo'<br>';
$turno = $explode[1];
echo'<br>';
$PK_codagend =  $explode[2];
echo'<br>';
$FK_nomerota =  $explode[3];
echo'<br>';
echo $FK_datarg = $explode[4];

}



$data_rota = $FK_datarg;

      $query = "SELECT * FROM rotavend WHERE PK_codrotav = '$PK_codrotav_'";  
      $result = mysqli_query($conexao, $query);  

      while($row = mysqli_fetch_array($result))  
      {  
  echo $PK_codrotav_;
  $turno = $row["turno"];
  
  echo '  
    <form method="POST"  id="form_enviar">
    Turno Atual: '.$turno.'<br><br>
';




echo'
<input type="text" id="PK_codagenda2" name="PK_codagenda2" value="'.$PK_codagend.'"/>
<input type="text" id="turnoagend"  value="'.$turno.'" name="turnoagend">
<input type="text" id="FK_datarg"  value="'.$FK_datarg.'" name="FK_datarg">
<input type="text" id="FK_nomerota2"  value="'.$FK_nomerota.'" name="FK_nomerota2">
';


if ($turno == "Manhã"){

echo'
<input type="radio" name="turno_escolhido" value="Horário Comercial">Horário Comercial 
<br>
<input type="radio" name="turno_escolhido" value="Tarde">Tarde';


}elseif($turno == "Tarde"){
  echo'
<input type="radio" name="turno_escolhido" value="Horário Comercial">Horário Comercial
<br>
<input type="radio" name="turno_escolhido" value="Manhã">Manhã';


}elseif($turno == "Horário Comercial"){
  echo'
<input type="radio" name="turno_escolhido" value="Tarde" >Tarde
<br>


<input type="radio" name="turno_escolhido" value="Manhã">Manhã
';
}else{
  echo "Turno Não Definido Ainda";
  echo'
<style>
#some{display:none;}
</style>
  ';
}

echo'
<br>
<br>
<center>
 <input type="submit"  name="mudaturno" class="btn btn-default"  value="Ok">  
</center>
</form>';

} 


 // mudar turno do agendamento 
if(isset($_POST['mudaturno'])){



 //puxa dos formularios 
$PK_codagendaa = $_POST['PK_codagenda2'];
$turnoagend = $_POST['turnoagend'];
$FK_nomerota2 = $_POST['FK_nomerota2'];
$FK_datarg = $_POST['FK_datarg'];
$turno_escolhido = $_POST['turno_escolhido'];





// procura se já existe alguma rota a tarde  
$select__t = "SELECT * from rotavend where turno = '$turno_escolhido' and FK_nomerota = '$FK_nomerota2' and FK_datarg = '$data_rota'";
$query__sel = mysqli_query($conexao, $select__t);
$num__rows = mysqli_num_rows($query__sel);
if($num__rows > 0){

while($puxa_cod = mysqli_fetch_assoc($query__sel)){
$PK_codrotav__ = $puxa_cod['PK_codrotav']; // codigo da rota existente
$quantidadeagend_ = $puxa_cod['quantidadeagend'];


// se existir:



// PEGA COD ROTA V DO AGENDAMENTO
$sel_agend = "SELECT * from agend where PK_codagend = '$PK_codagendaa'";
$queryz = mysqli_query($conexao, $sel_agend);
while($recebe_cod = mysqli_fetch_assoc($queryz)){
  $codrotav = $recebe_cod['FK_codrotav'];//rota v antiga



//MUDA A ROTA V DO AGENDAMENTO PARA NOVA
$update_agends = "UPDATE agend set FK_codrotav = '$PK_codrotav__' where PK_codagend = '$PK_codagendaa'"; 
$query__update_agend = mysqli_query($conexao, $update_agends);

// procura algum agendamento na rota v existente
$sel_qntd_agend_ = "SELECT * from agend where FK_codrotav = '$PK_codrotav__'";
$queryzona_ = mysqli_query($conexao, $sel_qntd_agend_);
$num_rows_qntd_ = mysqli_num_rows($queryzona_);

// update na rotavend existente sobre a quantidade de agendamentos
$update_rotavend = "UPDATE rotavend set quantidadeagend = '$num_rows_qntd_' where PK_codrotav = '$PK_codrotav__'";
$query_ry = mysqli_query($conexao, $update_rotavend);
if($query_ry == true){

header("Location: gerar_rotag2.php");
}


// procura algum agendamento na rota v antiga
$sel_qntd_agend = "SELECT * from agend where FK_codrotav = '$codrotav'";
$queryzona = mysqli_query($conexao, $sel_qntd_agend);
$num_rows_qntd = mysqli_num_rows($queryzona);


// ATUALIZA A QUANTIDADE DE AGENDAMENTO NA ROTA V ANTIGA
$up_ = "UPDATE rotavend set quantidadeagend = '$num_rows_qntd' where PK_codrotav = '$codrotav' ";
$queryz2 = mysqli_query($conexao, $up_);


$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$data2 = new DateTime($dataentrega);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];


if($status == 1){
$status = "Possui Pedido";
}else{
$status = "Caixão";
}


if($volume == 1){
$volume = "Possui Volume";
}else{
$volume = "N/";
}


$agendamentoinfo =  mysqli_query($conexao, "SELECT * from agend where PK_codagend = '$PK_codagendaa'");
while ($dados =  mysqli_fetch_assoc($agendamentoinfo)) {
  $cliente = $dados['cliente'];
  $endereco = $dados['endereco'];
  $FK_coduser = $dados['FK_coduser'];
$vendedorinfo =  mysqli_query($conexao, "SELECT * from usuario where PK_coduser = '$FK_coduser'");
while($dados2 =  mysqli_fetch_assoc($vendedorinfo)){
$vendedor = $dados2['username'];
}}

$descricao = "alterou o turno do agendamento: - Turno: ".$turnoagend." - Cliente: ".$cliente." - Vendedor: ".$vendedor." - Endereço: ".$endereco." para  - Turno: ".$turno_escolhido;



$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui

//aqui1


}// while agend (existente)
} // while rota vend (existente)


// Se não existir:
}else{

//inserindo nova rota vend so q versao tarde(mudar o bloqueado dps q funfar )
$insert_novarota2 = "INSERT INTO rotavend(FK_datarg, FK_nomerota, quantidadeagend, bloqueado, limiteagend, turno, tipo, entregador) VALUES('$FK_datarg', '$FK_nomerota2', '1', '0', '7', '$turno_escolhido', 'tarde', '$entregadorA')";
$query_novarota2 = mysqli_query($conexao, $insert_novarota2);
if($query_novarota2 == true){

//apos o insert ele  puxa o codigo da rotav criada acima
$Select___2 = "SELECT * from rotavend where FK_nomerota = '$FK_nomerota2' and FK_datarg = '$FK_datarg' order by PK_codrotav desc limit 1 ";
$query__2 = mysqli_query($conexao, $Select___2);
while($recebe_2 = mysqli_fetch_assoc($query__2)){
$PK_codrotav2 = $recebe_2['PK_codrotav'];//codigo da rotav criada



//e da um update no agendamento para inserir na rota v atual
$update__agend2 = "UPDATE agend set FK_codrotav = '$PK_codrotav2' where PK_codagend='$PK_codagendaa'";
$query___update2 = mysqli_query($conexao, $update__agend2);
if($query___update2 == true){


// quantidade de agendamentos na rota criada
$select__3 = "SELECT * from agend where FK_codrotav ='$PK_codrotav2' ";
$query__3 = mysqli_query($conexao, $select__3);
$num_rows_3 = mysqli_num_rows($query__3);
if($query__3 == true){
// Atualiza a rota com a quantidade de agendamentos existentes.
$update__ = "UPDATE rotavend set quantidadeagend = '$num_rows_3' where PK_codrotav = '$PK_codrotav2'";
$query__ = mysqli_query($conexao, $update__);

//aqui2



}
}
}




//Pega a rota da manha (pois precisa retirar 1 pq 1 agendamento vai pra tarde)
$select__t2 = "SELECT * from rotavend where turno = '$turnoagend' and FK_nomerota = '$FK_nomerota2' and FK_datarg = '$FK_datarg'";
$query__sel2 = mysqli_query($conexao, $select__t2);


//Puxa a quantidade de agendmento e o cod da rotav
while($qntdd2 = mysqli_fetch_assoc($query__sel2)){
$quantidadeagend22 = $qntdd2['quantidadeagend'];
$pk__codrotav2 = $qntdd2['PK_codrotav'];
}// while rota vend 


// procura a quantidade de agendamentos com a rota v antiga
$procura_agend = "SELECT * from agend where FK_codrotav = '$pk__codrotav2'";
$query_procura_agend = mysqli_query($conexao, $procura_agend);
$num_rows_4 = mysqli_num_rows($query_procura_agend);


// update na rotavend manha retirando 1 agendamento da quantidade de agend
$update_quantidade2 = "UPDATE rotavend set quantidadeagend  = '$num_rows_4' where PK_codrotav = '$pk__codrotav2'";
$update_query2 = mysqli_query($conexao, $update_quantidade2);
if($update_query2 == true){


header("Location: gerar_rotag2.php");
}//ultima query
} // while rotavend criada
}// fim do else ( else existe rota ou nao)
}//fecha isset


 ?>
 
<script type="text/javascript">
function enviar(){
    form=document.getElementById('form_enviar');
    form.submit();
    form.action='gerar_rotag2.php';
}

</script> 

</html>