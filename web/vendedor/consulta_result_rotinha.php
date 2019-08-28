<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
  include_once("../conexao.php");


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Vendedor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/tabela.css" rel="stylesheet"> 
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

<script src="js/skycons.js"></script>

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
include_once('menu_vendedor.php');
?>
<?php
$temErro = false;
$dataentrega = '';

$area = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
    $area = filter_input(INPUT_POST, 'area');

}
 $dataentrega = $_POST['dataentrega'];
$area = $_POST['area'];   // ... validações, inserts, updates, etc...

$verifica_bloqueio = "SELECT * from rotinha where FK_datarg = '$dataentrega'";
$resultblock = mysqli_query($conexao, $verifica_bloqueio); 
while($linhas = mysqli_fetch_array($resultblock)){
$bloque = $linhas['block'];
}

if($bloque == 1){


echo '<center><div class="form-group has-error">
<input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Essa Rotinha Já Foi Bloqueada">
</div><br><br><br><br><br>
<a href="meusagends.php" class=" btn btn-default">Voltar</a>
</center>';

   exit; //REMIND 682  
}else{    
?>


        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">

         <div class="content-main">
     <div class="table-responsive">
    <table class="greyGridTable" >   

<center>
<?php
date_default_timezone_set('America/Sao_Paulo');
$relogio = date('d-m-Y h:i:s', time());
$hr = date('H', time());
$dataabertura = date ("Y-m-d");
?>

<br>
    <input type="text"  value="<?=$area?>" readonly>

<input type="date" value="<?=$dataentrega?>"  name="dateentrega" disabled>

<a href="consultar.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 

<br>
<br>

<?php
//inicia consulta
$area = $_POST['area']; 
$dataentrega = $_POST['dataentrega']; 



// se a area == todos:
if($area == 'todos'){






$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];



$sql_nomerota2 = "SELECT * from rotavend where FK_datarg='$PK_datarg' order by FK_nomerota DESC";
$queryrota = mysqli_query($conexao,$sql_nomerota2);
while($linhas33 = mysqli_fetch_assoc($queryrota)){
$area_todos = $linhas33['FK_nomerota'];
    $PK_codrotav = $linhas33['PK_codrotav'];
    $quantidadeagend = $linhas33['quantidadeagend'];
    $bloqueado1 = $linhas33['bloqueado'];
    $entregador = $linhas33['entregador'];
    $transporte = $linhas33['transporte'];
    $turno = $linhas33['turno'];
    $FK_datarg = $linhas33['FK_datarg'];
    $FK_codrotinha = $linhas33['FK_codrotinha'];

    $sql_codrotava = "SELECT * from agend where FK_codrotav='$PK_codrotav' and FK_codrotinha = '$FK_codrotinha'";
    $query_rotava = mysqli_query($conexao,$sql_codrotava);
    $num_agends_rotinha = mysqli_num_rows($query_rotava);
    if(($quantidadeagend < 1) || ($num_agends_rotinha < 1)){   }
    elseif($num_agends_rotinha > 0){
    //desce camada 2

echo '
<form action="edit_agend.php" method="POST" >
<thead>
 <th colspan="100%"><h4>
 <input type="hidden" name="FK_nomerota" class="cnomerota" value="'.$area_todos.'" readonly/>';
 echo $area_todos;
 echo'
 </h4></th>';


echo'
<tr class="nomerota" >
<tr>
<th>VL</th>
<th>Cod. Agend.</th>
<th>Vendedor</th>
<th>Observaçoes</th>
<th>H. de Almoço</th>
<th>Status</th>
<th>Data Abertura</th>
<th>Data Entrega</th>
<th>Cliente</th>
<th>Endereço</th>
<th>Bairro</th>
<th>Cod. Ped.</th>
<th>Valor</th>
</thead>
';//fim do head da tabela




// seleciona dados do agendamento da data de entrega
$sql_codrotav = "SELECT * from agend where dataentrega='$dataentrega' and FK_codrotav='$PK_codrotav'";
$query_rotav = mysqli_query($conexao,$sql_codrotav);
$contador_todos= mysqli_num_rows($query_rotav);
//puxa os dados
while($linhas2 = mysqli_fetch_assoc($query_rotav)){
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser = $linhas2['FK_coduser'];
$FK_codrotinha = $linhas2['FK_codrotinha'];
$almoco = $linhas2['almoco'];
$obs = $linhas2['obs'];
$status = $linhas2['status'];
$dataabertura = $linhas2['dataabertura'];
$dataentrega = $linhas2['dataentrega'];
$volume = $linhas2['volume'];
$cliente = $linhas2['cliente'];
$endereco = $linhas2['endereco'];
$bairro = $linhas2['bairro'];
$quantidade = $linhas2['quantidade'];
$cf = $linhas2['cf'];

if (($FK_codrotinha != null) && ($FK_codrotinha <> 0)){
//puxa TODOS os nomes da rota daquele dia:
$sql_nomevendedor = "SELECT * from usuario where PK_coduser = '$FK_coduser'";
$queryusu = mysqli_query($conexao,$sql_nomevendedor);

while($nomevendedor = mysqli_fetch_assoc($queryusu)){
$nomevendedor = $nomevendedor['username'];


//corpo da tabela
echo'
<tbody>
<tr>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'">
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area_todos.'">

';

//campo volume
if($volume == 0){
echo '<td><input type="hidden" value="0" name="volume"> N/</td>';
}  
else{
echo '<td style="background-color:black;width:1px;"><input type="hidden" value="1" name="volume"></td>';
}
//Fim do volume


echo'
<td><input type="hidden" name="PK_codagend" value="'.$PK_codagend.'" style="width:25px;" readonly="readonly">'.$PK_codagend.'</td>

<td><input type="hidden" name="nomevendedor" value="'.$nomevendedor.'" style="width:90px;" readonly="readonly">'.$nomevendedor.'</td>

<td><input type="hidden" style="width:138px;height:90px;" name="obs" readonly>'.$obs.'</td>
<td><input type="hidden" name="almoco" value="'.$almoco.'" style="width:85px;" readonly="readonly">'.$almoco.'</td>
';
}//nome vendedor


//campo caixao
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);

if($conta_status > 0){
echo '<td><input type="hidden" value="1" name="status">Efetivado</td>';
}  
else{
echo '<td style="background-color:yellow;color:black;"><input type="hidden" value="0" name="status">Caixao</td>';
}

echo '
<td>
<input type="hidden" name="dataabertura" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">
'.$dataabertura.'</td>

<td>
<input type="hidden" name="dataentrega" style="width:100px;" value="'.$dataentrega.'" readonly="readonly">
'.$dataentrega.'</td>

<td>
<input type="hidden" name="cliente" style="width:120px;" value="'.$cliente.'" readonly="readonly">
'.$cliente.'</td>
<td>
<input type="hidden" name="endereco" style="width:120px;" value="'.$endereco.'" readonly="readonly">
'.$endereco.'</td>

<td>
<input type="hidden" name="bairro" style="width:90px;" value="'.$bairro.'" readonly="readonly">
  '.$bairro.'<br><br>
</td>
';


$sql_ped = "SELECT * from ped where FK_codagend='$PK_codagend' ";
$query_ped = mysqli_query($conexao,$sql_ped);
//puxa os dados de ped



echo'<td>';
while($l = mysqli_fetch_assoc($query_ped)){
                            echo $l['pedidos'];
                            echo"; ";}

echo'</td>';




$sql_ped3 = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_ped3 = mysqli_query($conexao,$sql_ped3);
//puxa os dados de ped
echo'<td>';
while($l3 = mysqli_fetch_assoc($query_ped3)){
                            echo $l3['valor'];
                            echo"; ";}

                            echo'</td>';

echo'</form>';


}else{ }// while rota vend
}//while rota geral
}//while agend
}
echo'
</tr>
</tbody>
</table>';
}//fecha if de agend rotinha
// se for uma especifica:
}else{ 
    




$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];




$sql_nomerota2 = "SELECT * from rotavend where FK_datarg='$dataentrega' and FK_nomerota='$area'";
$queryrota = mysqli_query($conexao,$sql_nomerota2);

while($linhas33 = mysqli_fetch_assoc($queryrota)){
$PK_codrotav = $linhas33['PK_codrotav'];
    $FK_nomerota = $linhas33['FK_nomerota'];
    $quantidadeagend = $linhas33['quantidadeagend'];
    $bloqueado = $linhas33['bloqueado'];
    $entregador = $linhas33['entregador'];
    $transporte = $linhas33['transporte'];
    $turno = $linhas33['turno'];
    $FK_datarg = $linhas33['FK_datarg'];

    $sql_codrotava = "SELECT * from agend where FK_codrotav='$PK_codrotav' and FK_codrotinha = '$FK_codrotinha'";
    $query_rotava = mysqli_query($conexao,$sql_codrotava);
    $num_agends_rotinha = mysqli_num_rows($query_rotava);
    if(($quantidadeagend < 1) || ($num_agends_rotinha < 1)){   }
    elseif($num_agends_rotinha > 0){






echo '
<form action="edit_agend.php" method="POST" >
<thead>
 <th colspan="100%"><h4>
 <input type="text" name="FK_nomerota" class="cnomerota" value="'.$area.'" readonly/>
 </h4></th>';


echo'
<tr class="nomerota" >
<tr>
<th>VL</th>
<th>Cod. Agend.</th>
<th>Vendedor</th>
<th>Observaçoes</th>
<th>H. de Almoço</th>
<th>Status</th>
<th>Data Abertura</th>
<th>Data Entrega</th>
<th>Cliente</th>
<th>Endereço</th>
<th>Bairro</th>
<th>Cod. Ped.</th>
<th>Valor</th>
</thead>
';//fim do head da tabela


$sql_final = "SELECT * from agend where FK_codrotav='$PK_codrotav' and dataentrega='$dataentrega'";
$queryfinal = mysqli_query($conexao,$sql_final);
$contarr = mysqli_num_rows($queryfinal);
while($linhas2 = mysqli_fetch_assoc($queryfinal)){
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser = $linhas2['FK_coduser'];
$FK_codrotinha = $linhas2['FK_codrotinha'];
$obs = $linhas2['obs'];
$almoco = $linhas2['almoco'];
$status = $linhas2['status'];
$dataabertura = $linhas2['dataabertura'];
$dataentrega = $linhas2['dataentrega'];
$volume = $linhas2['volume'];
$cliente = $linhas2['cliente'];
$endereco = $linhas2['endereco'];
$bairro = $linhas2['bairro'];
$quantidade = $linhas2['quantidade'];
$cf = $linhas2['cf'];


if (($FK_codrotinha != null) && ($FK_codrotinha <> 0)){

$sql_nomevendedor = "SELECT * from usuario where PK_coduser = '$FK_coduser'";
$queryusu = mysqli_query($conexao,$sql_nomevendedor);
while($nomevendedor = mysqli_fetch_assoc($queryusu)){
$nomevendedor = $nomevendedor['username'];




//corpo da tabela
echo'
<tbody>
<tr>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'">
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area.'">

';

//campo volume
if($volume == 0){
echo '<td><input type="hidden" value="0" name="volume"> N/</td>';
}  
else{
echo '<td style="background-color:black;width:1px;"><input type="hidden" value="1" name="volume"></td>';
}
//Fim do volume


echo'
<td><input type="text" name="PK_codagend" value="'.$PK_codagend.'" style="width:25px;" readonly="readonly"></td>
<td><input type="text" name="nomevendedor" value="'.$nomevendedor.'"  style="width:90px;" readonly="readonly"></td>
<td><textarea  style="width:138px;height:90px;" name="obs" readonly>'.$obs.'</textarea></td>
<td><input type="text" name="almoco" value="'.$almoco.'"  style="width:85px;" readonly="readonly"></td>
';

//campo caixao
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);

if($conta_status > 0){
echo '<td><input type="hidden" value="1" name="status">Efetivado</td>';
}  
else{
echo '<td style="background-color:yellow;color:black;"><input type="hidden" value="0" name="status">Caixao</td>';
}

echo '
<td>
<input type="text" name="dataabertura" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">
</td>

<td>
<input type="text" name="dataentrega" style="width:100px;" value="'.$dataentrega.'" readonly="readonly">
</td>

<td>
<input type="text" name="cliente" style="width:120px;" value="'.$cliente.'" readonly="readonly">
</td>
<td>
<input type="text" name="endereco" style="width:120px;" value="'.$endereco.'" readonly="readonly">
</td>

<td>
<input type="text" name="bairro" style="width:90px;" value="'.$bairro.'" readonly="readonly">
  <br><br>
</td>';


$sql_ped4 = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_ped4 = mysqli_query($conexao,$sql_ped4);
//puxa os dados de ped



echo'<td>';
while($l4 = mysqli_fetch_assoc($query_ped4)){
                            echo $l4['pedidos'];
                            echo"; ";}

echo'</td>';




$sql_ped5 = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_ped5 = mysqli_query($conexao,$sql_ped5);
//puxa os dados de ped
echo'<td>';
while($l5 = mysqli_fetch_assoc($query_ped5)){
                            echo $l5['valor'];
                            echo"; ";}

                            echo'</td>';






}// nome do vendedor
}// quantidade agend
}//rotavend while
}//rota geral

echo'
</tr>
</tbody>
</table></div>
';

}// fim da area especifica

}
}


?>


 


</form>

<?PHP
}
?>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>


</center>

        <!--banner-->   
        <!--//banner-->
        <!--content-->
        <div class="content-top">



</div>

    <div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
        </div>
        </div>
        <div class="clearfix"> </div>
       </div>
     </div> </div>
            </div>

        <!---->
    
  
        <div class="content-mid">
            
            
        </div>
    </div>
    </div>

        
            <div class="clearfix"> </div>
        </div>
        <!----->
        <!--<div class="content-bottom">
            
            <div class="clearfix"> </div>
        </div>-->

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--//content-->


     
        <!---->

<!---->
<!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"> </script>
</body>
</html>

