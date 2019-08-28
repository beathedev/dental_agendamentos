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
<title>Dental MV - Admin</title>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
if(date('N') > 4 ){
$data = new DateTime(date("Y-m-d"));
//act
$dataact = date();
$horaact = date("H:i:s");
//fim act
$data->modify('+3 day');
$data_rota=$data->format('Y-m-d');
$data_rota_layout=$data->format('d-m-Y');
}elseif(date('N') <= 4 ){
  //act
$dataact = date("d-m-Y");
$horaact = date("H:i:s");
//fim act
$data = date ("Y-m-d");
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');

// echo $data_rota;
}
$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
 $data_rota = $datadestino;
}
}
    // ... validações, inserts, updates, etc...
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
<center>
<br>

<div class="table-responsive">
<input type="date" value="<?=$data_rota?>"  name="dateentrega" disabled>
<a href="index.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 
    <table class="greyGridTable" >   

<?php



$sql_codrotav3 = "SELECT * from agend where dataentrega='$data_rota' and status='0'";
$query_rotav3 = mysqli_query($conexao,$sql_codrotav3);
$commta3 = mysqli_num_rows($query_rotav3);
if($commta3 < 1){
echo "Nenhum caixão";
}else{

while($linhas3 = mysqli_fetch_assoc($query_rotav3)){
$FK_codrotav = $linhas3['FK_codrotav'];
$PK_codagend = $linhas3['PK_codagend'];
$FK_coduser = $linhas3['FK_coduser'];
$FK_codrotav = $linhas3['FK_codrotav'];
$obs = $linhas3['obs'];
$status = $linhas3['status'];
$dataabertura = $linhas3['dataabertura'];
$dataentrega = $linhas3['dataentrega'];
$volume = $linhas3['volume'];
$cliente = $linhas3['cliente'];
$endereco = $linhas3['endereco'];
$bairro = $linhas3['bairro'];
$quantidade = $linhas3['quantidade'];
$cf = $linhas3['cf'];
}//WHILE AGENDAMENTO




echo'
<form method="POST">
<input type="HIDDEN" value="'.$data_rota.'" name="dataentrega2">

<!-- botao modal apagar -->
 <br> 
 <button type="button" name="view" id="'.$PK_codagend.','.$FK_codrotav.','.$dataentrega.'" class="btn btn-default view_data2" style="border:none;background-color:#F3F3F4;">
 </button><br>


 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"></h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>


</form>';
//puxa os dados
ECHO'<BR>';
ECHO'<BR>';



// ISSET APAGAR TUDO
if(isset($_POST['apagar_tudo'])){
$dataentrega2 = $_POST['dataentrega2'];


  $delete2 = "DELETE FROM agend where status=0 and dataentrega='$dataentrega2'";
  $queryz2 = mysqli_query($conexao, $delete2);

$selectt2 = "SELECT * FROM agend where FK_codrotav='$FK_codrotav'";
$queryy2 = mysqli_query($conexao, $selectt2);
$contarr2 = mysqli_num_rows($queryy2);
$update2 = "UPDATE rotavend set quantidadeagend='$contarr2' where PK_codrotav='$FK_codrotav' and FK_datarg='$dataentrega2'";
$query_2 = mysqli_query($conexao, $update2);


}//ISSET

?>
<br>




<?php


//puxando rota geral pela data 
$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$data_rota'";  
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];
$qtdrotav = $linhas1['qtdrotav']; 



//puxa TODOS os nomes da rota daquele dia:
$sql_nomerota2 = "SELECT * from rotavend where FK_datarg='$PK_datarg'  order by FK_nomerota ASC";
$queryrota = mysqli_query($conexao,$sql_nomerota2);
while($linhas33 = mysqli_fetch_assoc($queryrota)){
$area_todos = $linhas33['FK_nomerota'];
$quantidade_agend = $linhas33['quantidadeagend'];
$cod_rotav_ = $linhas33['PK_codrotav'];




$sql_codrotav2 = "SELECT * from agend where dataentrega='$PK_datarg' and FK_codrotav='$cod_rotav_' and status='0'";
$query_rotav2 = mysqli_query($conexao,$sql_codrotav2);
$commta2 = mysqli_num_rows($query_rotav2);

    if($commta2 < 1){  
// echo 'Nenhum agendamento encontrado';
// exit;
}elseif($commta2 >= 1){ 





//Começa cabeça da tabela

echo'

<thead>
<tr class="nomerota" >
<th colspan="100%">
<h4><input type="text" name="FK_nomerota" class="cnomerota" value="'.$area_todos.'" readonly/></h4>
</th>
</tr>
';


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
<th>Vendedor</th>
<th>Data Abertura</th>
<th>Data Entrega</th>
<th>#</th>

</tr>
</thead>
';


//seleciona dados do agendamento da data de entrega
$sql_codrotav = "SELECT * from agend where dataentrega='$PK_datarg' and FK_codrotav='$cod_rotav_' and status='0'";
$query_rotav = mysqli_query($conexao,$sql_codrotav);


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

$hr_almoco = $linhas2['almoco'];




echo'<form method="POST" style="background-color:white;border-top:4px #0E9A81 solid;">';

//corpo da tabela 
echo'
<tbody>
<tr>
';

// nome vendedor sql
$sql_nomevendedor = "SELECT * from usuario where PK_coduser = '$FK_coduser'";
$queryusu = mysqli_query($conexao,$sql_nomevendedor);
while($nomevendedor = mysqli_fetch_assoc($queryusu)){
$nomevendedor = $nomevendedor['username'];


//campo volume
if($volume == 0){   
echo '<td><input type="hidden" value="0" name="volume"> N/</td>';
}  
else{
echo '<td style="background-color:black;width:1px;"><input type="hidden" value="1" name="volume"></td>';
}

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
echo'<td>
<input type="hidden" name="cliente" style="" value="'.$cliente.'" readonly="readonly">';echo $cliente;
echo'</td>

<td><input type="hidden" style="width:138px;height:90px;" name="obs" value="'.$obs.'" readonly/>'; echo $obs;
echo '</td>';

echo'<td>
<input type="hidden" name="almoco" readonly value="'.$hr_almoco.'">'; echo $hr_almoco; 
echo'</td>';

echo'<td>
<input type="hidden" name="endereco" value="'.$endereco.'" readonly="readonly">'; echo $endereco;
echo' </td>';

echo'<td>
<input type="hidden" name="bairro" value="'.$bairro.'" readonly="readonly"/>'; echo $bairro;
echo '</td>';

echo '<td>
<input type="hidden" name="nomevendedor" value="'.$nomevendedor.'" style="width:50px;" readonly="readonly">'; 
  echo $nomevendedor;
echo'</td>';

echo '
<td>
<input type="hidden" name="dataabertura" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">'; 
    echo $dataabertura;
echo '</td>
<td>
<input type="hidden" name="dataentrega" style="width:100px;" value="'.$dataentrega.'" readonly="readonly">'; 
    echo $dataentrega;
echo '</td>';

echo'
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<input type="hidden"  name="area" value="'.$area_todos.'">
<input type="hidden" name="PK_codagend" value="'.$PK_codagend.'" style="width:25px;" readonly="readonly">';

echo'
<td>
 <button type="button" name="viewdata" id="'.$PK_codagend.','.$FK_codrotav.','.$dataentrega.'" class="btn btn-default btn-sm view_data" style="border:none;background-color:#F3F3F4;">
 <h5><span class="glyphicon" style="color:#0FA791;font-size:15px;">&#xe020</span>Apagar</h5>
 </button><br>


 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Você está prestes a apagar esse caixão, deseja continuar?</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>
</td>
';


//puxa os dados de ped
while($l = mysqli_fetch_assoc($query_status)){
$PK_codped = $l['PK_codped'];
$pedidos = $l['pedidos'];
$valor = $l['valor'];

echo'
<td><input type="hidden" name="PK_codped" value="'.$PK_codped.'" style="width:25px;" readonly="readonly"></td>
<td><input type="hidden" name="pedidos"  value="'.$pedidos.'"></td>
<td><input type="hidden" name="valor" style="width:100px;" value="'.$valor.'"></td>
';
//fim da tabela todos
}// while ped



echo'
</tr>

</tbody>';






echo'</form>';


}// while vendedor
}//while agend

}// quantidade agend

}// while vend
}//while rota geral
}
echo'</table>';


?>


 


<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var PK_codagend = $(this).attr("id");  
           $.ajax({  
                url:"caixao_del.php",  
                method:"post",  
                data:{PK_codagend:PK_codagend},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 }); 
</script>

<script>
 $(document).ready(function(){  
      $('.view_data2').click(function(){  
           var PK_codagend = $(this).attr("id");  
           $.ajax({  
                url:"caixao_del2.php",  
                method:"post",  
                data:{PK_codagend:PK_codagend},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 }); 
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

<?php


if(isset($_POST['apaga'])){

$PK_codagend =  $_POST['PK_codagend'];
$FK_codrotav =   $_POST['FK_codrotav'];
$dataentrega =   $_POST['dataentrega'];
$nome_cliente =  $_POST['nome_cliente'];
$nome_vendedor = $_POST['nome_vendedor'];
$nomeuser = $_SESSION['username'];


$descricao = "deletou o seguinte caixão: - Cliente:".$nome_cliente. " do vendedor:".$nome_vendedor;

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");


$delete = "DELETE FROM agend where PK_codagend='$PK_codagend'";
$queryz = mysqli_query($conexao, $delete);

$selectt = "SELECT * FROM agend where FK_codrotav='$FK_codrotav'";
$queryy = mysqli_query($conexao, $selectt);
$contarr = mysqli_num_rows($queryy);



$update = "UPDATE rotavend set quantidadeagend='$contarr' WHERE PK_codrotav='$FK_codrotav' and FK_datarg='$dataentrega'";
$query_ = mysqli_query($conexao, $update);
if($query_ == true){
  header("Location: caixao.php");

}else{
}
}




?>
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

