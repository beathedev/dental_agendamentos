<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
  include_once("../conexao.php");


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
<title>Dental MV - Supervisor</title>

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
include_once('menu.php');
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


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
<center>
<br>

<div class="table-responsive">
<input type="text"  value="<?=$area?>" readonly>
<input type="date" value="<?=$dataentrega?>"  name="dateentrega" disabled>
<a href="lista_agend.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 
    <table class="greyGridTable" >   
<input type="submit" name="alterar"  value="Alterar" class="btn-default" onclick="altera_form();">
<?php
//inicia consulta
$area = $_POST['area']; 
$dataentrega = $_POST['dataentrega']; 



// se a area == todos:
if($area == 'todos'){


//puxando rota geral pela data 
$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];
$qtdrotav = $linhas1['qtdrotav']; 





//puxa TODOS os nomes da rota daquele dia:
$sql_nomerota2 = "SELECT * from rotavend where FK_datarg='$PK_datarg' order by FK_nomerota ASC";
$queryrota = mysqli_query($conexao,$sql_nomerota2);

while($linhas33 = mysqli_fetch_assoc($queryrota)){
$area_todos = $linhas33['FK_nomerota'];
$quantidade_agend = $linhas33['quantidadeagend'];
$cod_rotav_ = $linhas33['PK_codrotav'];
    if($quantidade_agend < 1){  
// echo 'Nenhum agendamento encontrado';
// exit;
}elseif($quantidade_agend >= 1){ 


//Começa cabeça da tabela
echo'
<thead>
<tr class="nomerota" >
<th colspan="12">
<h4><input type="text" name="FK_nomerota" class="cnomerota" value="'.$area_todos.'" readonly/></h4>
</th>
</tr>

';

//seleciona dados do agendamento da data de entrega
$sql_codrotav = "SELECT * from agend where dataentrega='$dataentrega' and FK_codrotav='$cod_rotav_' ";
$query_rotav = mysqli_query($conexao,$sql_codrotav);

echo'
<thead>
<tr>
<th>VL</th>
<th>Cod. Agend.</th>
<th>Vendedor</th>
<th>Observaçoes</th>
<th>Status</th>
<th>Data Abertura</th>
<th>Data Entrega</th>
<th>Cliente</th>
<th>Endereço</th>
<th>Bairro</th>
<th>#</th>
<th>Cod. Ped.</th>
<th>Valor</th>
<th>#</th>

</tr>
</thead>
';

//puxa os dados
while($linhas2 = mysqli_fetch_assoc($query_rotav)){
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser = $linhas2['FK_coduser'];
$FK_codrotav = $linhas2['FK_codrotav'];
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


// nome vendedor sql
$sql_nomevendedor = "SELECT * from usuario where PK_coduser = '$FK_coduser'";
$queryusu = mysqli_query($conexao,$sql_nomevendedor);
while($nomevendedor = mysqli_fetch_assoc($queryusu)){
$nomevendedor = $nomevendedor['username'];


//Cabeça da tabela



//corpo da tabela
echo'
<form method="POST" id="form1" action="edit_agend_admin.php" style="background-color:white;border-top:4px #0E9A81 solid;">


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

echo'
<td><input type="text" name="PK_codagend" value="'.$PK_codagend.'" style="width:25px;" readonly="readonly">
</td>
<td>
<input type="text" name="nomevendedor" value="'.$nomevendedor.'" style="width:50px;" readonly="readonly">
</td>
<td><textarea  style="width:138px;height:90px;" name="obs" readonly>'.$obs.'</textarea></td>';


//campo caixao
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);
//contador p/ caixao
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
</td>
';

//sql ped
$sql_ped = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_ped = mysqli_query($conexao,$sql_ped);

//puxa os dados de ped
while($l = mysqli_fetch_assoc($query_ped)){
$PK_codped = $l['PK_codped'];
$pedidos = $l['pedidos'];
$valor = $l['valor'];}

echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['pedidos'];
                            echo '<input type="hidden" name="pedidos" value="'.$linhasp1['pedidos'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}

echo'
</td>';


echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['PK_codped'];
                            echo '<input type="hidden" name="PK_codped" value="'.$linhasp1['PK_codped'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}

echo'
</td>';




echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['valor'];
                            echo '<input type="hidden" name="valor" value="'.$linhasp1['valor'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}




echo'
<td><input type="submit" name="aa"  value="Editar">'.$PK_codagend.'
<br>
<input type="checkbox" name="alterar[]" value="'.$PK_codagend.'"> Alterar área do agend</td>
';


echo'</form>';
//fim da tabela todos
}// quantidade agend
}//while agend
}// while rotavend
}// while vendedor
}// while rotag


echo'</table>';


// se for uma especifica:
}elseif($area != "todos"){ 
    


//puxando rota geral pela data 
$sql2 = "SELECT * from rotageral WHERE PK_datarg = '$dataentrega'";  
$query2 = mysqli_query($conexao, $sql2);
while($linhas2_ = mysqli_fetch_array($query2)){
$PK_datarg2 = $linhas2_['PK_datarg'];
$codrotageral2 = $linhas2_['codrotageral'];
$qtdrotav2 = $linhas2_['qtdrotav']; 


//puxa TODOS os nomes da rota daquele dia:
$sql_nomerota2 = "SELECT * from rotavend where FK_datarg='$PK_datarg2' and FK_nomerota='$area'";
$queryrota = mysqli_query($conexao,$sql_nomerota2);
while($linhas33 = mysqli_fetch_assoc($queryrota)){

$area_todos2 = $linhas33['FK_nomerota'];
$quantidade_agend2 = $linhas33['quantidadeagend'];
$cod_rotav_2 = $linhas33['PK_codrotav'];
    if($quantidade_agend2 < 1){  
// echo 'Nenhum agendamento encontrado';
// exit;
}elseif($quantidade_agend2 >= 1){ 

//Começa cabeça da tabela
echo'
<thead>
<tr class="nomerota" >
<th colspan="12">
<h4><input type="text" name="FK_nomerota" class="cnomerota" value="'.$area.'" readonly/></h4>
</th>
</tr>
';


// seleciona dados do agendamento da data de entrega
$sql_final = "SELECT * from agend where  FK_codrotav ='$cod_rotav_2' AND dataentrega='$dataentrega'";
$queryfinal = mysqli_query($conexao,$sql_final);
echo'
<thead>
<tr>
<th>VL</th>
<th>Cod. Agend.</th>
<th>Vendedor</th>
<th>Observaçoes</th>
<th>Status</th>
<th>Data Abertura</th>
<th>Data Entrega</th>
<th>Cliente</th>
<th>Endereço</th>
<th>Bairro</th>
<th>#</th>
<th>Cod. Ped.</th>
<th>Valor</th>
</tr>
</thead>
';

while($linhas2 = mysqli_fetch_assoc($queryfinal)){
$FK_codrotav = $linhas2['FK_codrotav'];
$PK_codagend = $linhas2['PK_codagend'];
$FK_coduser = $linhas2['FK_coduser'];
$FK_codrotav = $linhas2['FK_codrotav'];
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


$sql_nomevendedor = "SELECT * from usuario where PK_coduser = '$FK_coduser'";
$queryusu = mysqli_query($conexao,$sql_nomevendedor);
while($nomevendedor = mysqli_fetch_assoc($queryusu)){
$nomevendedor = $nomevendedor['username'];



//corpo da tabela
echo'
<form method="POST" id="form1" action="edit_agend_admin.php" style="background-color:white;border-top:4px #0E9A81 solid;">
<tbody>
<tr>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'">
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area.'">';



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
<td><input type="text" name="nomevendedor" value="'.$nomevendedor.'" style="width:50px;" readonly="readonly"></td>
<td><textarea  style="width:138px;height:90px;" name="obs" readonly>'.$obs.'</textarea></td>';

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

$sql_ped = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_ped = mysqli_query($conexao,$sql_ped);
//puxa os dados de ped
while($l = mysqli_fetch_assoc($query_ped)){
$PK_codped = $l['PK_codped'];
$pedidos = $l['pedidos'];
$valor = $l['valor'];
}// fim while do ped



echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['pedidos'];
                            echo '<input type="hidden" name="pedidos" value="'.$linhasp1['pedidos'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}

echo'
</td>';


echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['PK_codped'];
                            echo '<input type="hidden" name="PK_codped" value="'.$linhasp1['PK_codped'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}

echo'
</td>';




echo'<td>';
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);
     while ($linhasp1 = mysqli_fetch_array($queryp1)){
                                  echo $linhasp1['valor'];
                            echo '<input type="hidden" name="valor" value="'.$linhasp1['valor'].'" style="width:25px;" readonly="readonly">';
                            echo"; ";}

echo'
</td>';



echo'
<td><input type="submit"  name="aa"  value="Editar">'.$PK_codagend.'
<br>
<input type="checkbox" name="alterar[]" value="'.$PK_codagend.'"> Alterar área do agend</td>
';
echo'</form>';

}// while nome vendedor
}// while agend
}//while rotav
}// while rota geral
}//quantidade agend

echo
'</tr>
</tbody>
</table>';

}// fim da area especifica
?>


<!-- <script type="text/javascript">
 function edita_form(){
  form=document.getElementById('form1');
        form.action='edit_agend_admin.php';
        form.submit();
}

</script>
 -->

<script type="text/javascript">
   function altera_form(){
  form=document.getElementById('form1');
        form.action='muda_area.php';
        form.submit();
}

</script>

</div>
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

