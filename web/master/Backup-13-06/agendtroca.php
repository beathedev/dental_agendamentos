<title>Dental MV - Admin</title><?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
  header('location: ../index.php');
}
  include_once("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
    <script>
    $(function () {
      $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
      if (!screenfull.enabled) {
        return false;
      }
      $('#toggle').click(function () {
        screenfull.toggle($('#container')[0]);
      });
    });
    </script>

<!---->

<!--pie-chart-->
<script src="js/pie-chart.js" type="text/javascript"></script>
<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<style type="text/css">
    input[type=date]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}

   table.greyGridTable {
  border: 0px solid #FFFFFF;

  width: 100%;
  text-align: center;
  border-collapse: collapse;

}
    #oi{
        color: black;
    }
table.greyGridTable td, table.greyGridTable th {
  border: 1px solid #FFFFFF;
  padding: 3px 4px;
}
table.greyGridTable tbody{
    border-left: 2px solid #333333;
    border- right: 2px solid #333333;
    border-bottom: 0px solid #333333;

}
table.greyGridTable tbody td {
  font-size: 13px;
  border-bottom: none;
}
table.greyGridTable td:nth-child(even) {
  background: #EBEBEB;
}
table.greyGridTable thead {
  background: #FFFFFF;
  border: 2px solid #333333;
  border-bottom: none; 
}
table.greyGridTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #333333;
  text-align: center;
  
}
table.greyGridTable thead th:first-child {
  border-left: none;
}
table.greyGridTable thead tr.nomerota {
  border-top: 4px solid #0FA791;
  border-bottom: 1px solid #333333;
}

table.greyGridTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  border-top: 4px solid #333333;
}
table.greyGridTable tfoot td {
  font-size: 14px;
}
input[type="text"]{
  width: 150px;
  height: 20px;
  text-align: center;
  padding: 0px;
  /*border: none;*/
}
input[type="text"].cnomerota{
  width: 250px;
  height: 30px;
  
}
input[type="text"].cf{
  width: 60px;
  height: 20px;
}

}

</style>       
<div id="wrapper">
<?php
include_once('menu.php');
include_once('../graficos.php');

?>
<?php
$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}

?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main"> 
                          <div class="table-responsive">

              <table class="greyGridTable" >
<?php

if(isset($_POST['alterar'])){
 echo $datas = $_POST['datas'];
 echo $PK_codagend = $_POST['PK_codagend'];
 echo $FK_codrotav = $_POST['FK_codrotav'];
}

echo  '<center><p class=""> Agendamento(s):</p></center>';
echo  '<center><h5> Selecione Abaixo Para Mudar a Data</h5></center>';

$consult1 = mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav='$FK_codrotav'");

echo'<form action="" method="POST">';

echo'

<thead>
<tr>
<th>VL</th>
<th>Status</th>
<th>Cliente</th>
<th>OBS/PGT</th>
<th>H. de Almoço</th>
<th>Endereço</th>
<th>Bairro</th>
<th>Ped.</th>
<th>Valor</th>
<th>Vendedor</th>
<th>Data Abertura</th>
<th>Data Entrega</th>

<th>&darr;</th>

</tr>
</thead>
';



echo'<tbody> <tr>';

while($t = mysqli_fetch_array($consult1)){

$FK_coduser = $t['FK_coduser'];
$FK_codrotav = $t['FK_codrotav'];
$hr_almoco = $t['almoco'];
$PK_codagend = $t['PK_codagend'];
$obs = $t['obs'];
$status = $t['status'];
$dataabertura = $t['dataabertura'];
$dataentrega = $t['dataentrega'];
$volume = $t['volume'];
$cliente = $t['cliente'];
$endereco = $t['endereco'];
$bairro = $t['bairro'];
$quantidade = $t['quantidade'];
$cf = $t['cf'];


$consult2 =  mysqli_query($conexao, "SELECT * FROM usuario WHERE PK_coduser='$FK_coduser'");
while($t1 = mysqli_fetch_array($consult2)){
$vendedor = $t1['username'];
}


ECHO'<TD>'.$volume.'</TD>';
ECHO'<TD>'.$status.'</TD>';
ECHO'<TD>'.$cliente.'</TD>';
ECHO'<TD>'.$obs.'</TD>';
ECHO'<TD>'.$hr_almoco.'</TD>';
ECHO'<TD>'.$endereco.'</TD>';
ECHO'<TD>'.$bairro.'</TD>';
echo'<td>';


$sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
$queryp1 = mysqli_query($conexao, $sqlp1);
while ($linhasp1 = mysqli_fetch_array($queryp1)){
   echo $linhasp1['pedidos'];
   echo"; ";}

$sqlp2 = "SELECT valor FROM ped WHERE FK_codagend = '$PK_codagend'";
$queryp2 = mysqli_query($conexao, $sqlp2);
   echo'</td> <td>';
while ($linhasp2 = mysqli_fetch_assoc($queryp2)){
   echo $linhasp2['valor'];
   echo "; ";
}


echo'</td>';
ECHO'<TD>'.$vendedor.'</TD>';
ECHO'<TD>'.$dataabertura.'</TD>';
ECHO'<TD>'.$dataentrega.'</TD>';
ECHO'<TD><input type="checkbox" style="width:40px;" name="agend[]" value='.$PK_codagend.','.$FK_codrotav.'></TD>
</tr>';


}// while






?>

</tbody>
</table>
</div>
<br><br>
<center><p class="">Após selecionar, escolha uma nova data e/ou área</p>



  <?php
echo '<label>Data nova: <input type="date"  value="'.$datas.'" name="data_nova"></label>
<select name="area">
<option>Selecione a area:</option>';


$sql = "SELECT * from area";
$query = mysqli_query($conexao,$sql);
while($linhas = mysqli_fetch_assoc($query)){
$PK_nomerota = $linhas['PK_nomerota'];
echo '<option  value="'.$PK_nomerota.'">'.$PK_nomerota.'</option>';
}
echo'</select>';



echo '<input type="hidden"  name="PK_codagend"  value='.$PK_codagend.'>';
echo '<input type="hidden"  name="FK_codrotav"  value='.$FK_codrotav.'>';
echo ' <button type="submit" name="envio" class="btn btn-primary">Enviar</button><br><br>';
echo '</form>';
if(isset($_POST['envio'])){
$data_nova = $_POST['data_nova'];
$PK_codagend = $_POST['PK_codagend'];
$area = $_POST['area'];
// $codigos = implode(',', $agend);
// $explode = explode(',', $codigos);
//==//
// echo $PK_codagend =  $explode[0];
 $FK_codrotav =  $_POST['FK_codrotav'];



//rota antiga


//rota nova
$consult4 = mysqli_query($conexao, "SELECT * FROM rotavend WHERE FK_datarg='$data_nova' and FK_nomerota='$area'");
$existe = mysqli_num_rows($consult4);
if($existe > 0){
while($t2 = mysqli_fetch_array($consult4)){
$FK_codrotav_nova = $t2['PK_codrotav'];
}


$upd1 =  mysqli_query($conexao, "UPDATE agend set FK_codrotav = '$FK_codrotav_nova', dataentrega='$data_nova' WHERE PK_codagend='$PK_codagend'");


$consult7 =  mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav='$FK_codrotav_nova'");
$quantidade_nova = mysqli_num_rows($consult7);

$upd2 = mysqli_query($conexao, "UPDATE rotavend set quantidadeagend = '$quantidade_nova' WHERE PK_codrotav='$FK_codrotav_nova'");


$consult10 =  mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav='$FK_codrotav'");
$quantidade_antiga = mysqli_num_rows($consult10);

$upd3 = mysqli_query($conexao, "UPDATE rotavend set quantidadeagend = '$quantidade_antiga' WHERE PK_codrotav='$FK_codrotav'");

if($upd3 == true){
ECHO'
<div class="alert alert-success" role="alert">
  Agendamento movido com sucesso!
</div>
';
    // header("Refresh: 4; url=lista_area.php");



}else{
ECHO'
<div class="alert alert-danger" role="alert">
  Ocorreu um erro ao mover o agendamento, contate o suporte.
</div>
';
    // header("Refresh: 4; url=lista_area.php");

}


}else{




// cria rota geral
$sql_insere = "INSERT INTO rotageral(PK_datarg) VALUES ('$data_nova')";
$result_insere = mysqli_query($conexao, $sql_insere);

// pega o nome das rotas ativas
$sql_consulta = "SELECT PK_nomerota from area WHERE status='1'";
$results = mysqli_query($conexao, $sql_consulta); 
while ($linhass = mysqli_fetch_array($results)) {
$PK_nomerota2 =$linhass['PK_nomerota'];//variavel com o nome de rotas ativas




/*bloquear a rota vend*/
$sql_inseree = "INSERT INTO rotavend(FK_datarg, FK_nomerota) VALUES ('$data_nova', '$PK_nomerota2')";
$result_inseree = mysqli_query($conexao, $sql_inseree);
}// area  

$sql_consultaa = "SELECT * from rotavend where FK_datarg = '$data_nova' and FK_nomerota='$area'";
$resultaa = mysqli_query($conexao, $sql_consultaa); 
while($linhas = mysqli_fetch_array($resultaa)){ 
$FK_codrotav_nova = $linhas['PK_codrotav'];

$upd3 =  mysqli_query($conexao, "UPDATE agend set FK_codrotav = '$FK_codrotav_nova', dataentrega='$data_nova' WHERE PK_codagend='$PK_codagend'");

$consult5  =  mysqli_query($conexao, "SELECT * from agend where FK_codrotav = '$FK_codrotav_nova'");
$quantidade_nova = mysqli_num_rows($consult5);

//rota antiga
$consult6 =  mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav='$FK_codrotav'");
$quantidade_antiga = mysqli_num_rows($consult6);

// while($t4 = mysqli_fetch_array($consult6)){ 
// $FK_codrotav_antiga = $t4['FK_codrotav'];
// $PK_codagend = $t4['PK_codagend'];
$upd4 = mysqli_query($conexao, "UPDATE rotavend set quantidadeagend = '$quantidade_nova' WHERE PK_codrotav='$FK_codrotav_nova'");
$upd6 = mysqli_query($conexao, "UPDATE rotavend set quantidadeagend = '$quantidade_antiga' WHERE PK_codrotav='$FK_codrotav'");

if($upd3 == true){
ECHO'
<div class="alert alert-success" role="alert">
  Agendamento movido com sucesso!
</div>
';
header("Refresh: 4; url=lista_area2.php");
}else{
ECHO'
<div class="alert alert-danger" role="alert">
  Ocorreu um erro ao mover o agendamento, contate o suporte.
</div>
';
    header("Refresh: 4; url=lista_area2.php");

}// }
}
}





}

  ?>

</center>


<br>

</div>
</div>


  <br> <br> <br> <br><br> <br> <br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>
 <br>
  <div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
      </div>
    </div>
    <div class="clearfix"> </div>
       </div>
     </div> </div>
  </div>
  <div class="content-mid">   
  </div>
  </div>
  </div>
  <div class="clearfix"> </div>
  </div>
  </div>
</div>
<div class="clearfix"> </div>
</div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"> </script>
</body>
</html>