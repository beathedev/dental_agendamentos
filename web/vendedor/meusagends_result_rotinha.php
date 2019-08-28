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
<meta name="keywords"/>


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

<!----->


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
    // ... validações, inserts, updates, etc...
?>



        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">

         <div class="content-main">
          <?php

//Verica se a rota está bloqueada

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
}else{    ?>
<center>
          <div class="table-responsive">
    <table class="greyGridTable" >   
<?php
date_default_timezone_set('America/Sao_Paulo');
$data_rota=$_POST['dataentrega'];

$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
 $data_rota = $datadestino;
 $dataentrega = $data_rota;
}
}

?>

<br>
 	<input type="text" name="area" value="<?=$area?>" disabled> &nbsp;
  <input type="date" value="<?=$dataentrega?>" disabled> &nbsp;

<a href="meusagends.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 

<br>
<br>

<?php
//inicia consulta
if(isset($_POST['consultar'])){
    //pega area e a data entrega

 $area = $_POST['area']; 
 $dataentrega = $_POST['dataentrega']; 
$username = $_SESSION['username'];
 $PK_coduser = $_SESSION['coduser'];




// se a area == todos:
if($area == 'todos'){

//puxa os dados do usuario
$sql_usu2 = "SELECT * from usuario where username='$username'";
$query4 = mysqli_query($conexao,$sql_usu2);
while($linha = mysqli_fetch_assoc($query4)){
$nomevendedor = $linha['username'];

$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];

$sql_nomerota = "SELECT * from rotavend where FK_datarg='$dataentrega'";
$query4= mysqli_query($conexao,$sql_nomerota);
$contador_area = mysqli_num_rows($query4);
while($linhas4 = mysqli_fetch_assoc($query4)){
     $PK_codrotav = $linhas4['PK_codrotav'];
    $FK_nomerota = $linhas4['FK_nomerota'];
    $quantidadeagend = $linhas4['quantidadeagend'];
    $bloqueado = $linhas4['bloqueado'];
    $entregador = $linhas4['entregador'];
    $transporte = $linhas4['transporte'];
    $turno = $linhas4['turno'];
    $FK_datarg = $linhas4['FK_datarg'];
    $FK_codrotinha = $linhas4['FK_codrotinha'];
$sql_codrotav = "SELECT * from agend where FK_codrotav = '$PK_codrotav' and FK_coduser = '$PK_coduser' and dataentrega='$FK_datarg' and FK_codrotinha='$FK_codrotinha'";
$query_agend_esp = mysqli_query($conexao,$sql_codrotav);
$contador=mysqli_num_rows($query_agend_esp);



$sql_codrotava = "SELECT * from agend where FK_codrotav='$PK_codrotav' and FK_codrotinha = '$FK_codrotinha'";
$query_rotava = mysqli_query($conexao,$sql_codrotava);
 $num_agends_rotinha = mysqli_num_rows($query_rotava);
if($num_agends_rotinha < 1){   }
elseif($num_agends_rotinha > 0){


echo '

<thead>
<tr class="nomerota" >
 <th colspan="100%"><h4>
 <input type="text" name="FK_nomerota" class="cnomerota" value="'.$FK_nomerota.'" readonly/>
 </h4></th></tr>'; 



echo'
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
<th>#</th>
</tr>
</thead>
';//fim do head da tabela   



// seleciona dados do agendamento da data de entrega e da area



//puxa os dados
while($linhas2 = mysqli_fetch_assoc($query_agend_esp)){
//   echo'<form action="edit_agend.php" method="GET" style="background-color:white;border-top:4px #0E9A81 solid;">
// ';
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser2 = $linhas2['FK_coduser'];
$FK_codrotinha = $linhas2['FK_codrotinha'];
$obs = $linhas2['obs'];
$almoco = $linhas2['almoco'];
$status = $linhas2['status'];
$dataabertura = $linhas2['dataabertura'];
$dataentrega = $linhas2['dataentrega'];
#$turno = $linhas2[#'turno'];
$volume = $linhas2['volume'];
$cliente = $linhas2['cliente'];
$endereco = $linhas2['endereco'];
$bairro = $linhas2['bairro'];
$quantidade = $linhas2['quantidade'];
$cf = $linhas2['cf'];

//puxa os dados de usuario
$sql_usu = "SELECT * from usuario where PK_coduser='$PK_coduser'";
$query3 = mysqli_query($conexao,$sql_usu);
while($linha = mysqli_fetch_assoc($query3)){
$nomevendedor = $linha['username'];










//corpo da tabela
echo'
<form action="edit_agend.php" method="GET" style="background-color:white;border-top:4px #0E9A81 solid;">
<INPUT TYPE="HIDDEN"  name="PK_codagend" value="'.$PK_codagend.'" >
 <input type="hidden" name="FK_nomerota" class="cnomerota" value="'.$area_todos.'" readonly/>

<tbody>
<tr>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'">
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area_todos.'">

';

//campo volume
if($volume == 0){
echo '<td><input type="hidden" value="0"> N/</td>';
}  
else{
echo '<td style="background-color:black;width:1px;"><input type="hidden" value="1" ></td>';
}
//Fim do volume
// name="volume"
//  name="volume"
//campo caixao
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);

echo'
<input type="hidden"  style="width:25px;" readonly="readonly">';

if($conta_status > 0){
echo '<td><input type="hidden" value="1" >Efetivado</td>';
}  
else{
echo '<td style="background-color:yellow;color:black;">Caixao<input type="hidden" value="0" ></td>';
}
// name="status"
// name="status"
// name="cliente" 
// name="obs"
// name="almoco"
// name="endereco" 
//  name="bairro"


echo'
<input type="hidden" style="width:120px;" value="'.$cliente.'" readonly="readonly">
<td>'.$cliente.'</td>
<input type="hidden"  style="width:138px;height:90px;"  value="'.$obs.'">
<td>'.$obs.'</td>
<input type="hidden" value="'.$almoco.'" >
<td>'.$almoco.'</td>
<input type="hidden" style="width:120px;" value="'.$endereco.'" readonly="readonly">
<td>'.$endereco.'</td>
<input type="hidden" style="width:90px;" value="'.$bairro.'" readonly="readonly">
<td>'.$bairro.'</td>';

$sql_ped = "SELECT * from ped where FK_codagend='$PK_codagend'";
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
// name="nomevendedor"


echo'
<input type="hidden"  value="'.$nomevendedor.'" style="width:50px;" readonly="readonly">
<td>'.$nomevendedor.'</td>';


// name="dataabertura" 
 // name="dataentrega"

echo '

<input type="hidden" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">
<td>'.$dataabertura.'</td>
<input type="hidden" style="width:100px;" value="'.$dataentrega.'" readonly="readonly">
<td>'.$dataentrega.'</td>
<td><input type="submit" name="editar" class="btn btn-default" value="Editar"></td>';


echo'</form>';







}//while usuario
}// while agend
}//quantidade agend
} // while rota vend
}//while usuario

}//while rota geral
////////
echo'</tr></tbody>
</table>
';



}// se for uma especifica:
else{
    

//puxa os dados do usuario
$sql_usu2 = "SELECT * from usuario where username='$username'";
$query4 = mysqli_query($conexao,$sql_usu2);
while($linha = mysqli_fetch_assoc($query4)){
$nomevendedor = $linha['username'];

$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];

$sql_nomerota = "SELECT * from rotavend where FK_datarg='$dataentrega' and FK_nomerota='$area'";
$query4= mysqli_query($conexao,$sql_nomerota);
$contador_area = mysqli_num_rows($query4);
while($linhas4 = mysqli_fetch_assoc($query4)){
     $PK_codrotav = $linhas4['PK_codrotav'];
    $FK_nomerota = $linhas4['FK_nomerota'];
    $quantidadeagend = $linhas4['quantidadeagend'];
    $bloqueado = $linhas4['bloqueado'];
    $entregador = $linhas4['entregador'];
    $transporte = $linhas4['transporte'];
    $turno = $linhas4['turno'];
    $FK_datarg = $linhas4['FK_datarg'];
    $FK_codrotinha = $linhas4['FK_codrotinha'];
$sql_codrotav = "SELECT * from agend where FK_codrotav = '$PK_codrotav' and FK_coduser = '$PK_coduser' and dataentrega='$FK_datarg' and FK_codrotinha='$FK_codrotinha'";
$query_agend_esp = mysqli_query($conexao,$sql_codrotav);
$contador=mysqli_num_rows($query_agend_esp);



$sql_codrotava = "SELECT * from agend where FK_codrotav='$PK_codrotav' and FK_codrotinha = '$FK_codrotinha'";
$query_rotava = mysqli_query($conexao,$sql_codrotava);
 $num_agends_rotinha = mysqli_num_rows($query_rotava);
if($num_agends_rotinha < 1){ echo "entrou";  }
elseif($num_agends_rotinha > 0){


echo '

<thead>
<tr class="nomerota" >
 <th colspan="100%"><h4>
 <input type="text" name="FK_nomerota" class="cnomerota" value="'.$FK_nomerota.'" readonly/>
 </h4></th></tr>'; 



echo'
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
<th>#</th>
</tr>
</thead>
';//fim do head da tabela   



// seleciona dados do agendamento da data de entrega e da area



//puxa os dados
while($linhas2 = mysqli_fetch_assoc($query_agend_esp)){
//   echo'<form action="edit_agend.php" method="GET" style="background-color:white;border-top:4px #0E9A81 solid;">
// ';
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser2 = $linhas2['FK_coduser'];
$FK_codrotinha = $linhas2['FK_codrotinha'];
$obs = $linhas2['obs'];
$almoco = $linhas2['almoco'];
$status = $linhas2['status'];
$dataabertura = $linhas2['dataabertura'];
$dataentrega = $linhas2['dataentrega'];
#$turno = $linhas2[#'turno'];
$volume = $linhas2['volume'];
$cliente = $linhas2['cliente'];
$endereco = $linhas2['endereco'];
$bairro = $linhas2['bairro'];
$quantidade = $linhas2['quantidade'];
$cf = $linhas2['cf'];

//puxa os dados de usuario
$sql_usu = "SELECT * from usuario where PK_coduser='$PK_coduser'";
$query3 = mysqli_query($conexao,$sql_usu);
while($linha = mysqli_fetch_assoc($query3)){
$nomevendedor = $linha['username'];










//corpo da tabela
echo'
<form action="edit_agend.php" method="GET" style="background-color:white;border-top:4px #0E9A81 solid;">
<INPUT TYPE="HIDDEN"  name="PK_codagend" value="'.$PK_codagend.'" >
 <input type="hidden" name="FK_nomerota" class="cnomerota" value="'.$area_todos.'" readonly/>

<tbody>
<tr>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'">
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area_todos.'">

';

//campo volume
if($volume == 0){
echo '<td><input type="hidden" value="0"> N/</td>';
}  
else{
echo '<td style="background-color:black;width:1px;"><input type="hidden" value="1" ></td>';
}
//Fim do volume
// name="volume"
//  name="volume"
//campo caixao
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);

echo'
<input type="hidden"  style="width:25px;" readonly="readonly">';

if($conta_status > 0){
echo '<td><input type="hidden" value="1" >Efetivado</td>';
}  
else{
echo '<td style="background-color:yellow;color:black;">Caixao<input type="hidden" value="0" ></td>';
}
// name="status"
// name="status"
// name="cliente" 
// name="obs"
// name="almoco"
// name="endereco" 
//  name="bairro"


echo'
<input type="hidden" style="width:120px;" value="'.$cliente.'" readonly="readonly">
<td>'.$cliente.'</td>
<input type="hidden"  style="width:138px;height:90px;"  value="'.$obs.'">
<td>'.$obs.'</td>
<input type="hidden" value="'.$almoco.'" >
<td>'.$almoco.'</td>
<input type="hidden" style="width:120px;" value="'.$endereco.'" readonly="readonly">
<td>'.$endereco.'</td>
<input type="hidden" style="width:90px;" value="'.$bairro.'" readonly="readonly">
<td>'.$bairro.'</td>';

$sql_ped = "SELECT * from ped where FK_codagend='$PK_codagend'";
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
// name="nomevendedor"


echo'
<input type="hidden"  value="'.$nomevendedor.'" style="width:50px;" readonly="readonly">
<td>'.$nomevendedor.'</td>';


// name="dataabertura" 
 // name="dataentrega"

echo '

<input type="hidden" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">
<td>'.$dataabertura.'</td>
<input type="hidden" style="width:100px;" value="'.$dataentrega.'" readonly="readonly">
<td>'.$dataentrega.'</td>
<td><input type="submit" name="editar" class="btn btn-default" value="Editar"></td>';


echo'</form>';







}//while usuario
}// while agend
}//quantidade agend
} // while rota vend
}//while usuario
}
}//while rota geral
////////
echo'</tr></tbody>
</table>
';


}// fim da area especifica
}// fim do isset


// }
?>



</center>

        <!--banner-->   
        <!--//banner-->
        <!--content-->
        <div class="content-top">



</div>
<br><br><br>
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

