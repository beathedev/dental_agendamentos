<?php
    include_once("../conexao.php");

if(date('N') > 4 ){
$data = new DateTime(date("Y-m-d"));
$data->modify('+3 day');
$data_rota=$data->format('Y-m-d');
$data_rota_layout=$data->format('d-m-Y');
}elseif(date('N') <= 4 ){
$data = date ("Y-m-d");
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');
}

if(isset($_POST['codarea'])){
$string = $_POST['codarea'];
$explode = explode(',',$string);
$codarea = $explode[0];
$FK_nomerota = $explode[1];
$status =$explode[2];


echo'
<form method="POST" action="lista_area.php" id="formConfirm">
<input type="hidden" name="codarea" value="'.$codarea.'" readonly="readonly">
<input type="hidden" name="area" value="'.$FK_nomerota.'" readonly="readonly">
<input type="hidden" name="status" value="'.$status.'" readonly="readonly">
<input type="submit" name="enviar" value="Inativar" class="btn btn-primary some">

</form>';


$sl = mysqli_query($conexao, "SELECT * FROM rotavend WHERE FK_nomerota = '$FK_nomerota' and FK_datarg >= '$data_rota'");
while($sla = mysqli_fetch_assoc($sl)){
  $codrv = $sla['PK_codrotav']; echo'<br>';
  $quantidadeagend = $sla['quantidadeagend'];
  $dt2[] = $FK_datarg = $sla['FK_datarg'];
  $FK_nomerota = $sla['FK_nomerota'];

  // echo $quantidadeagend; 
  // echo $codrv.'<br>';
  $slag = mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav = '$codrv'");
  $num[] = $numsla = mysqli_num_rows($slag);
// echo $numsla;



if($numsla > 0){

//valor atribuido para puxar a condiçao em baixo.
$possuiagend = "sim";
echo'<style>
.some{
	display:none;
}

</style>';

}else{//else contador

$possuiagend = "nao";

}

if($possuiagend == "sim"){

$date1 = new DateTime($FK_datarg);
$dt = $date1->format( 'd-m-Y' );
echo'<div class="alert alert-warning">
  Existem agendamentos futuros nesta área: '.$FK_nomerota.'<BR> <br> Clique no botão abaixo para trocar a área dos agendamentos:<br><br>';
echo'<form action="agendamentos_troca.php" method="POST">';
echo '<input type="hidden"  name="datas"        value='.$FK_datarg.'>';

 while($slagg = mysqli_fetch_assoc($slag)){
    $codagend = $slagg['PK_codagend']; 
echo '<input type="hidden"  name="PK_codagend"  value='.$codagend.'>';
  }//while agend

echo '<input type="hidden"  name="FK_codrotav"  value='.$codrv.'>';

//pega os agendamentos e as datas correspondentes
for ($i=0; $i <count($num) ; $i++) {
if($num[$i] == 0){
  // n exibe os valores das rotas q n possuem agendamentos 
}else{
  // exibe somente as rotas que possuem agendamentos
echo $num[$i].' agendamento(s) na data '.$dt2[$i];
}//if
}//for

echo'&nbsp<button type="submit" name="alterar" class="btn btn-primary">Alterar</button><br><br>';
echo '</form>';

}

  }// while rotavend

echo '</div>';





}
?>