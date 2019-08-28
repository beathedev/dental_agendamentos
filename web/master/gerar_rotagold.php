<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
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
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>

<!--modal window -->
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  




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

<!--pie-chart--->
<script src="js/pie-chart.js" type="text/javascript"></script>

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<style type="text/css">

@media print{
.content-main{
  overflow: hidden; 
}

.preto{
  background-color: black;
}
#botao{
  display: none;
}

@page {size: landscape}
}
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
  border: none;
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
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
?>
<style type="text/css">
  #some{
    display: none;  }
</style>
<div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
     <center>        
      <div class="table-responsive">
    <table class="greyGridTable" >   
    
 <?php
 exibir_dados();

function exibir_dados() {
$conexao = mysqli_connect("localhost", "root", "", "projeto2test");
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
echo'<input type="date" name="" value="'.$data_rota.'" readonly/><br><br>';

$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$data_rota'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];


echo'<form action="cadastrar_agend.php" method="POST">
<input type="hidden" name="dataentrega" value="'.$PK_datarg.'" readonly style="border:none; 
  background-color:#F3F3F4;">
<button type="submit" name="enviar" class="btn btn-default" style="margin-left:10px; padding: 7.5px;">
<h5><span style="color:#0FA791;font-size:15px;"class="glyphicon">&#xe081;</span>Novo Agendamento</h5>
 </button>
</TR></form><br><br>';

echo'  <thead>
<tr class="nomerota" >
<form action="impressaobangu.php" method="POST" target="_blank">
<input type="HIDDEN" value="'.$PK_datarg.'" name="PK_datarg"> 
<input type="HIDDEN" value="'.$codrotageral.'" name="codrotageral">

<input type="submit" value="Impressao Bangu" name="imprimiu" class="btn btn-default" style="margin-left:10px;">
</form>

<form action="impressao.php" method="POST" target="_blank">
<input type="HIDDEN" value="'.$PK_datarg.'" name="PK_datarg"> 
<input type="HIDDEN" value="'.$codrotageral.'" name="codrotageral">
<div style="style="background-color:white;width:40%; height:50%;">
<label>Filtrar (por entregador)
<select name="entregador_imprimir"></label>
<option value="Todos">Todos</option>';


// e puxa o nome do resto dos entregadores
$entregador = "SELECT * from usuario where niveluser = 'entregador' and status = 1 and username != '$entregador_2'";
$query_entrega = mysqli_query($conexao, $entregador);
while($recebbe = mysqli_fetch_assoc($query_entrega)){
$entregador = $recebbe['username'];
echo '<option value="'.$entregador.'">'.$entregador.'</option>';
}// fim while entregadores.

echo'</select></div>';




echo'

<input type="submit" value="Imprimir" name="imprimiu" class="btn btn-default" style="margin-left:10px;">
</form>
';
echo'
</thead>
 ';

echo'
<br><br>';




$qtdrotav = $linhas1['qtdrotav']; //desce camada 1
 $sql2 = "SELECT * from rotavend WHERE FK_datarg = '$PK_datarg'  ORDER BY FK_nomerota ASC";  
 //puxando rotas de vendedor da RG
    $query2 = mysqli_query($conexao, $sql2);
    $contador2 = mysqli_num_rows($query2);
    while($linhas2 = mysqli_fetch_array($query2)){
    $PK_codrotav = $linhas2['PK_codrotav'];
    $FK_nomerota = $linhas2['FK_nomerota'];
    $quantidadeagend = $linhas2['quantidadeagend'];
    $bloqueado = $linhas2['bloqueado'];
    $entregador = $linhas2['entregador'];
    $transporte = $linhas2['transporte'];
    $turno = $linhas2['turno'];
    $FK_datarg = $linhas2['FK_datarg'];
    $FK_codrotinha = $linhas2['FK_codrotinha'];
    if($FK_codrotinha != ""){
      $sl_rotinhaqtd = mysqli_query($conexao, "SELECT * FROM rotinha WHERE PK_codrotinha ='$FK_codrotinha'");
      while($sl_rotinhaqtd2 = mysqli_fetch_assoc($sl_rotinhaqtd)){
        $qtd_rotinha = $sl_rotinhaqtd2['qtd_rotinha'];
    $rok = "ok";}
    }else{$rok="nok";}
    if($quantidadeagend < 1 ){   }
    elseif($quantidadeagend >= 1 || $qtd_rotinha >= 1){ 
    //desce camada 2
    
               echo '<thead>';



#echo '<h3>Tarde</H3>';
   
//Form do nathan:
echo '<form method="POST" action="" id="formDel">';
    echo '<thead>
 <tr class="nomerota" >
         
         <input type="hidden" name="bloqueadoA" value="'.$bloqueado.'"/>
         <input type="hidden" name="PK_codrotava" value="'.$PK_codrotav.'"/>';

// echo'
//  <label> codigo da rota vend:
//             <input type="hidden" value="'.$PK_codrotav.'"></label>';


         echo'
            <th colspan="3"><h4><input type="text" name="FK_nomerota" class="cnomerota" value="'.$FK_nomerota.'" readonly/></h4></th>
<th colspan="2">
<h5>Entregador:
<select name="entregadorA">';

$entregador_ = "SELECT * from rotavend where FK_datarg = '$FK_datarg' and PK_codrotav = '$PK_codrotav'";
$query_entregador_ = mysqli_query($conexao, $entregador_);
//Procura se existe nome de vendedor na rota:
while($recebe_entreg = mysqli_fetch_assoc($query_entregador_)){
$entregador_2 = $recebe_entreg['entregador'];
echo $entregador_2;}

// se tiver vazio aparece a opçao de escolher o entregador:
if($entregador_2  == null ){

echo'<option id="some_op">Escolher Entregador</option>';

// se nao aparece o nome do entregador já preenchido:
}else{
echo'<option value="'.$entregador_2.'">'.$entregador_2.'</option>';
}

// e puxa o nome do resto dos entregadores
$entregador = "SELECT * from usuario where niveluser = 'entregador' and status = 1 and username != '$entregador_2'";
$query_entrega = mysqli_query($conexao, $entregador);
while($recebbe = mysqli_fetch_assoc($query_entrega)){
$entregador = $recebbe['username'];
echo '<option value="'.$entregador.'">'.$entregador.'</option>';
}// fim while entregadores.

echo'</th></select></h5>';




//Transporte
if($transporte == 0){
echo'                                             
  <th colspan="2"><h5>Transporte: </h5><h6>
  Moto <input type="radio" name="transporteA"  checked value="0">
  Carro <input type="radio" name="transporteA" value="1">
';
}elseif($transporte == 1){
echo'                                             
  <th colspan="2"><h5>Transporte: </h5><h6>
  Moto <input type="radio" name="transporteA" value="0">
  Carro <input type="radio" name="transporteA" checked value="1">
';
}else{
echo'                                             
  <th colspan="2"><h5>Transporte: </h5><h6>
  Moto <input type="radio" name="transporteA"   value="0">
  Carro <input type="radio" name="transporteA" value="1">
';
}



//Turno
if($turno == "Manhã"){
    echo'                                             
<th colspan="4"><h5>Turno: </h5><h6>
  Manha <input type="radio" name="turnoA" value="Manhã" readonly checked>
  Tarde <input type="radio" name="turnoA"  value="Tarde">
  Horário Comercial <input type="radio" name="turnoA"  value="Horário Comercial">

';
}elseif($turno == "Tarde"){
    echo'                                             
<th colspan="4"><h5>Turno: </h5><h6>
  Manha <input type="radio" name="turnoA" value="Manhã" readonly >
  Tarde <input type="radio" name="turnoA" checked value="Tarde" >
  Horário Comercial <input type="radio" name="turnoA"  value="Horário Comercial">

';
}elseif($turno == "Horário Comercial"){
      echo'                                             
<th colspan="4"><h5>Turno: </h5><h6>
  Manha <input type="radio" name="turnoA" value="Manhã" readonly >
  Tarde <input type="radio" name="turnoA"  value="Tarde" >
  Horário Comercial <input type="radio" name="turnoA"  value="Horário Comercial" checked>

';
}else{
  echo'
<th colspan="4"><h5>Turno: </h5><h6>
  Manha <input type="radio" name="turnoA" value="Manhã" readonly >
  Tarde <input type="radio" name="turnoA"  value="Tarde" >
  Horário Comercial <input type="radio" name="turnoA"  value="Horário Comercial">';
}



//Cabeça da Tabela
echo'
</th>
          <th colspan="2"><input type="submit" value="Salvar" name="edit" onClick="funcao2()"/></th>
           <th colspan=""></th>
            </tr>
            <tr>
            <th style="width:1px;">VL</th>
            <th>Cliente</th>
            <th>OBS/PGT</th>
             <th>H. de Almoço</th>
            <th>Endereço</th>
            <th>Bairro</th>
            <th>Pedidos</th>
            <th>Valor</th>
            <th>Vendedor</th>
            <th>PED</th>
            <th>CF</th>
            <th>QTD</th>
            <th>#</th>
            </tr>
            </thead>
';


//Select agendamentos

        $sql3 = "SELECT * from agend WHERE FK_codrotav = '$PK_codrotav' ORDER BY bairro ASC";  //puxando agendamentos dessas rotas de vendedores
        $query3 = mysqli_query($conexao, $sql3);
        $cont3 = mysqli_num_rows($query3);
        while($linhas3 = mysqli_fetch_array($query3)){
            $PK_codagend = $linhas3['PK_codagend'];
         $FK_coduser = $linhas3['FK_coduser'];
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
$hr_almoco = $linhas3['almoco'];


//Select nome do vendedor
            $sqlp3 = "SELECT * from usuario WHERE PK_coduser = '$FK_coduser'";
            $queryp3 = mysqli_query($conexao, $sqlp3);
            while($recebb = mysqli_fetch_assoc($queryp3)){
              $nome_vendedor = $recebb['username'];
            



            echo' 
            <tbody>
            <tr class="mudae">';
// Volume           
if($volume == 0){ echo '<td style="width:1px;">N/</td>';
}else{ 
echo '<td style="background-color:black;width:1px;"></td>'; 
}
             echo'
            <td>'.$cliente.'</td>
            <td>'.$obs.'</td>
            <td>'.$hr_almoco.'</td>
            <td>'.$endereco.'</td>
            <td>'.$bairro.'</td>';

echo'<input type="hidden" class="" name="PK_codagenda[]" value="'.$PK_codagend.'">';



}// fim do while nome vendedor

echo'
<td>';
                    // Puxando pedidos desses agends
                    $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
                    $queryp1 = mysqli_query($conexao, $sqlp1);
                    while ($linhasp1 = mysqli_fetch_array($queryp1)){
                            echo $linhasp1['pedidos'];
                            echo"; ";}

                    $sqlp2 = "SELECT valor FROM ped WHERE FK_codagend = '$PK_codagend'";
                    $queryp2 = mysqli_query($conexao, $sqlp2);
                    echo'</td> <td>';
                    while ($linhasp2 = mysqli_fetch_assoc($queryp2)){
                             echo 'R$ '.$linhasp2['valor'];
                            echo "; ";
                        }//}

echo'
</td>
<td>'.$nome_vendedor.'</td>
            
';
/*
$select_status = "SELECT * from ped where FK_codagend='$PK_codagend'";
$query_status= mysqli_query($conexao, $select_status);
$conta_status = mysqli_num_rows($query_status);
while($recebera =  mysqli_fetch_assoc($query_status)){
 $pedidosss = $recebera['pedidos'];
 if($pedidosss != 0 && ($status == 1 )){
echo '<td><input type="hidden" value="1" name="status">Efetivado';
echo'</td>';
}else{
echo '<td style="background-color:yellow;color:black;"><input type="hidden" value="0" name="status">Caixao';
echo'</td>';
}}*/
//contador p/ caixao


$contae = mysqli_num_rows($queryp1);



                          if ($contae<1){
							  echo $FK_nomerota; echo$status;
					
                              echo '<td style="background-color:yellow">Caixao entrei1';
                            }elseif($status == 0){
							 echo '<td style="background-color:yellow">Caixao entrei2';
							}else{
                              echo '<td>'.$contae;
                            }
echo'

     <td> <input type = "text" class="cf" name="cfd[]"  value="'.$cf.'" style="background-color: #EBEBEB;"/></td>
            <td><input type="text" class="cf" name="qntd_agend[]" value="'.$quantidade.'" style="background-color: #EBEBEB;"/></td>
</td>
';

// <!-- botao modal mudar turno -->
echo'


 <td>
<input type="button" name="view" value="Mudar Turno" id="'.$PK_codrotav.','.$turno.','.$PK_codagend.','.$FK_nomerota.','.$FK_datarg.'" class="btn btn-default view_data" />
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Mudar Turno</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>

<!-- form com informaçoes p mudar turno e apagar -->
<input type="hidden" name="PK_codagenda2" value="'.$PK_codagend.'"/>
<input type="hidden" value="'.$turno.'" name="turnoagend">
<input type="hidden" value="'.$FK_datarg.'" name="FK_datarg">
<input type="hidden" value="'.$FK_nomerota.'" name="FK_nomerota2">
<input type="hidden" value="'.$PK_codrotav.'" name="PK_codrotavtp">


<!-- botao modal apagar -->
 <br> 
 <button type="button" name="excluir" id="'.$PK_codagend.','.$PK_codrotav.'" class="btn btn-default btn-sm view_data2" style="border:none;background-color:#F3F3F4;">
 <h5><span class="glyphicon" style="color:#0FA791;font-size:15px;">&#xe020</span>Excluir</h5>
 </button><br>


 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Apagar Agendamento</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>








</td></tbody></tr>';






}//while agend



}//fim else
echo'</form>';



}//while Rota de Vendedores 





?>






<!--FIM DO CÓDIGO NOVO-->
<?php 







if(isset($_POST['excluir'])){



$cod_agenda = $_POST['PK_codagende'];
$cod_rotav_del = $_POST['PK_codrotave'];
$select_b1 = mysqli_query($conexao,"SELECT * FROM agend WHERE PK_codagend = '$cod_agenda'");




$delete_1 = "DELETE FROM ped where FK_codagend = '$cod_agenda'";
$query_delete_1 = mysqli_query($conexao, $delete_1);

$delete_ = "DELETE FROM agend where PK_codagend = '$cod_agenda'";
$query_delete_ = mysqli_query($conexao, $delete_);
header("Location: gerar_rotag.php");
if($query_delete_ == true){
  $delete_qqrct = mysqli_query($conexao,"SELECT * FROM agend WHERE FK_codrotav = '$cod_rotav_del'");
  $delete_cont = mysqli_num_rows($delete_qqrct);
  $up_delete_cont = mysqli_query($conexao, 
    "UPDATE rotavend set quantidadeagend = '$delete_cont' where PK_codrotav='$cod_rotav_del'");
}


$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$data2 = new DateTime($FK_datarg);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];



while($data = mysqli_fetch_assoc($select_b1)){
  $nomecliente = $data['cliente'];
  $FK_coduser = $data['FK_coduser'];
  $cfold = $data['cf'];
  $qtdold = $data['quantidade'];
$select_b2 = mysqli_query($conexao, "SELECT * from usuario where PK_coduser = '$FK_coduser'");
while($data1 = mysqli_fetch_assoc($select_b2)){
$vendedor = $data1['username'];

}}




$descricao = "deletou o seguinte agendamento: - Cliente: ".$nomecliente." - Vendedor: ".$vendedor." - Endereço: ".$endereco;

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui



}





if(isset($_POST['edit'])){


$PK_codagenda2 = $_POST['PK_codagenda2'];
$PK_codrotava_ = $_POST['PK_codrotava'];
$entregadorA = $_POST['entregadorA'];
$transporteA = $_POST['transporteA'];
$FK_nomerota_ = $_POST['FK_nomerota'];
$turnoA = $_POST['turnoA'];
$bloqueadoA = $_POST['bloqueadoA'];

$cfd = $_POST['cfd']; /* CF NÃO ALTERAR SOB NENHUMA CIRCUNSTANCIA */

$qtdagend = $_POST['qntd_agend'];
$PK_codagenda = $_POST['PK_codagenda'];
$PK_codrotava = $_POST['PK_codrotava'];
$sql2 = mysqli_query($conexao, "SELECT * from agend WHERE FK_codrotav = '$PK_codrotava'");
$contsl=mysqli_num_rows($sql2);

for($aumenta = 0; $aumenta < $contsl; $aumenta ++){
  $select_a1 = mysqli_query($conexao, "SELECT  * from agend where PK_codagend='$PK_codagenda[$aumenta]'");
  //$cfd[$aumenta]=$_POST['cfd'];
  //$quantidade=$_POST['qtdagend'];
  $a = $aumenta + 1;
  $ins2 = mysqli_query($conexao, "UPDATE agend SET quantidade = '$qtdagend[$aumenta]', cf ='$cfd[$aumenta]' WHERE PK_codagend = '$PK_codagenda[$aumenta]'");





// teste inicia aqui 
$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$data2 = new DateTime($FK_datarg);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];


while($dados = mysqli_fetch_assoc($select_a1)){
  $nomecliente = $dados['cliente'];
  $FK_coduser = $dados['FK_coduser'];
  $cfold = $dados['cf'];
  $qtdold = $dados['quantidade'];
  $select_a3 = mysqli_query($conexao, "SELECT * from usuario where PK_coduser = '$FK_coduser'");
    while($dados3 = mysqli_fetch_assoc($select_a3))
    {
      $vendedor = $dados3['username'];
    }



$descricao = "definiu as seguintes alterações na rota geral do dia ".$data_." na área ".$FK_nomerota_." - Informações do Agendamento: - Código: ".$PK_codagenda[$aumenta]." - Nome Cliente: ".$nomecliente." - Vendedor ".$vendedor." - Endereço: ".$endereco." - CF:".$cfold." - QTD: ".$qtdold." - alterado para CF: ".$cfd[$aumenta]." -  QTD: ".$qtdagend[$aumenta];

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui
}

            }
            if($ins2 == true){
            header("Location: gerar_rotag.php");
          }
            // FIM CF NÃO ALTERAR SOB NENHUMA CIRCUNSTANCIA

$select_a2 = mysqli_query($conexao, "SELECT * from rotavend where PK_codrotav = '$PK_codrotava_'");




//(CASO MUDE O TURNO) PROCURA A ROTA
$procura_rota = "SELECT * from rotavend where FK_datarg = '$FK_datarg' and FK_nomerota = '$FK_nomerota_' and turno = '$turnoA'";
$query_rota = mysqli_query($conexao, $procura_rota);
$cont = mysqli_num_rows($query_rota);


//Se já existir:
if($cont >= 1){
while($recebe_rota = mysqli_fetch_assoc($query_rota)){
  $PK_codrotav_existe = $recebe_rota['PK_codrotav'];





//pega tods agendamentos na "rota antiga"
$select_agend = "SELECT * from agend where PK_codagend = '$PK_codagenda2'";
$query__4 = mysqli_query($conexao, $select_agend);
while ($recebe_agendamentos = mysqli_fetch_assoc($query__4)){
$FK_codrotav_old = $recebe_agendamentos['FK_codrotav'];

// passa os agendamentos pra rota existente
$up_agends = "UPDATE agend set FK_codrotav = '$PK_codrotav_existe' where FK_codrotav='$FK_codrotav_old'";
$up_query = mysqli_query($conexao, $up_agends);


//pega os agends q estao na rota nova
$select__6 = "SELECT * from agend where FK_codrotav = '$PK_codrotav_existe'";
$query__6 = mysqli_query($conexao, $select__6);
$num_rows_7 = mysqli_num_rows($query__6);

//da update na quantidade de agend
$up_rota = "UPDATE rotavend set quantidadeagend = '$num_rows_7' where PK_codrotav='$PK_codrotav_existe'";
$rota_query = mysqli_query($conexao, $up_rota);
#header("Location: gerar_rotag.php");


$dl = "DELETE FROM rotavend where PK_codrotav = '$PK_codrotava_'";
$qr_dl = mysqli_query($conexao, $dl);


}//while rota v old

if($entregadorA == "Escolher Entregador"){
 
  $update_ins1 = mysqli_query($conexao, "UPDATE rotavend SET transporte = '$transporteA', turno ='$turnoA' WHERE PK_codrotav = '$PK_codrotav_existe'");

}else{

  $update_ins1 = mysqli_query($conexao, "UPDATE rotavend SET entregador='$entregadorA', transporte = '$transporteA' , turno = '$turnoA' where PK_codrotav = '$PK_codrotav_existe'");
}//else

if($update_ins1 == true){

$dataact = date("d-m-Y");
$horaact = date("H:i:s");



//AQUI
$data2 = new DateTime($FK_datarg);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];

//while
while($dados2 = mysqli_fetch_assoc($select_a2)){
   $transporte_old = $dados2['transporte'];
  $turno_old = $dados2['turno'];
  $entregador_old = $dados2['entregador'];

if($transporte_old == 0){
 $transporte_old = "Moto";
}else{
 $transporte_old = "Carro";
}




//if
if($transporteA == 0){
$transporteA = "Moto";

$descricao = " definiu as seguintes alterações na rota geral do dia ".$data_." na área ".$FK_nomerota_."
 Informações do agendamento: - Entregador: ".$entregador_old." - Transporte: ".$transporte_old." - Turno: ".$turno_old.", Alteradas para:  - Entregador: ".$entregadorA." - Transporte: ".$transporteA." - Turno: ".$turnoA;
}elseif($transporteA == 1 ){
$transporte_old = "Carro";
$descricao = " definiu as seguintes alterações na rota geral do dia ".$data_." na área ".$FK_nomerota_."
 Informações do agendamento: - Entregador: ".$entregador_old." - Transporte: ".$transporte_old." - Turno: ".$turno_old.", Alteradas para:  - Entregador: ".$entregadorA." - Transporte: ".$transporteA." - Turno: ".$turnoA;
}
//fim if

}
//fim while

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");



  // header("Location: gerar_rotag.php");
}



}//pk cod rota v existe


}// se nao existir:
else{


//inserindo nova rota vend so q versao tarde(mudar o bloqueado dps q funfar )
$insert_novarota_ = "INSERT INTO rotavend(FK_datarg, FK_nomerota, quantidadeagend, bloqueado, limiteagend, turno, tipo, entregador) VALUES('$FK_datarg', '$FK_nomerota_', '1', '$bloqueadoA', '7', '$turnoA', 'tarde','$entregadorA')";
$query_novarota_ = mysqli_query($conexao, $insert_novarota_);
if($query_novarota_ == true){


//agendamento na rotav antiga

$sl = "SELECT * from agend where PK_codagend = '$PK_codagenda2'";
$qry_ = mysqli_query($conexao, $sl);
while ($recebe_agendamentos2 = mysqli_fetch_assoc($qry_)){
$FK_codrotav_old2 = $recebe_agendamentos2['FK_codrotav'];



//apos o insert ele  puxa o codigo da rotav criada acima
$sl1 = "SELECT * from rotavend where FK_nomerota = '$FK_nomerota_' and FK_datarg = '$FK_datarg' order by PK_codrotav desc limit 1 ";
$qry = mysqli_query($conexao, $sl1);
while($recebe_q = mysqli_fetch_assoc($qry)){
$PK_codrotav_nova = $recebe_q['PK_codrotav'];//codigo da rotav criada


//e da um update no agendamento para inserir na rota v atual
$update__agend22 = "UPDATE agend set FK_codrotav = '$PK_codrotav_nova' where FK_codrotav='$FK_codrotav_old2'";
$query___update22 = mysqli_query($conexao, $update__agend22);
if($query___update22 == true){


// quantidade de agendamentos na rota criada
$sl2 = "SELECT * from agend where FK_codrotav ='$PK_codrotav_nova' ";
$qry2 = mysqli_query($conexao, $sl2);
$num_rows_7 = mysqli_num_rows($qry2);


if($qry2 == true){
// Atualiza a rota com a quantidade de agendamentos existentes.
$update__ = "UPDATE rotavend set quantidadeagend = '$num_rows_7' where PK_codrotav = '$PK_codrotav_nova'";
$query__ = mysqli_query($conexao, $update__);


$sl3 = "SELECT * from agend where FK_codrotav ='$FK_codrotav_old2' ";
$qry3 = mysqli_query($conexao, $sl3);
$num_rows_8 = mysqli_num_rows($qry3);



$upl = "UPDATE rotavend set quantidadeagend ='$num_rows_8' where PK_codrotav ='$FK_codrotav_old2'";
$qry4 = mysqli_query($conexao, $upl);
if($qry4 == true){
$dataact = date("d-m-Y");
$horaact = date("H:i:s");


//AQUI
$data2 = new DateTime($FK_datarg);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];
//while
while($dados2 = mysqli_fetch_assoc($select_a2)){
   $transporte_old = $dados2['transporte'];
  $turno_old = $dados2['turno'];
  $entregador_old = $dados2['entregador'];

if($transporte_old == 0){
 $transporte_old = "Moto";
}else{
 $transporte_old = "Carro";
}


//if
if($transporteA == 0){
$transporteA = "Moto";

$descricao = "definiu as seguintes alterações na rota geral do dia ".$data_." na área ".$FK_nomerota_."
 Informações do agendamento: - Entregador: ".$entregador_old." - Transporte: ".$transporte_old." - Turno: ".$turno_old.", Alteradas para:  - Entregador: ".$entregadorA." - Transporte: ".$transporteA." - Turno: ".$turnoA;
}elseif($transporteA == 1){

$transporteA = "Carro";
$descricao = " definiu as seguintes alterações na rota geral do dia ".$data_." na área ".$FK_nomerota_."
 Informações do agendamento: - Entregador: ".$entregador_old." - Transporte: ".$transporte_old." - Turno: ".$turno_old.", Alteradas para:  - Entregador: ".$entregadorA." - Transporte: ".$transporteA." - Turno: ".$turnoA;
}
//fim if

}
//fim while

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
header("Location: gerar_rotag.php");

}


$dl = "DELETE FROM rotavend where PK_codrotav = '$PK_codrotava_'";
$qr_dl = mysqli_query($conexao, $dl);


if($entregadorA = "Escolher Entregador"){
  
  $ins3 = mysqli_query($conexao, "UPDATE rotavend SET  transporte = '$transporteA', turno ='$turnoA' WHERE PK_codrotav = '$PK_codrotav_nova'");

}else{


         $ins2 = mysqli_query($conexao, "UPDATE rotavend SET entregador = '$entregadorA', transporte = '$transporteA', turno ='$turnoA' WHERE PK_codrotav = '$PK_codrotav_nova'");



if($ins2 == true){

header("Location: gerar_rotag.php");
}
if($ins3 == true){


header("Location: gerar_rotag.php");
}


}//else

}//da sim menor

}// query 2
}//query update
}//while rota v cod
}//while rota v old
}//query nova rota



}// fim do else






}//while Rota Geral

}// isset edit


?>


<?php

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

header("location: gerar_rotag.php");
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
$insert_novarota2 = "INSERT INTO rotavend(FK_datarg, FK_nomerota, quantidadeagend, bloqueado, limiteagend, turno, tipo, entregador) VALUES('$FK_datarg', '$FK_nomerota2', '1', '$bloqueadoA'', '7', '$turno_escolhido', 'tarde', '$entregadorA')";
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


 header("location: gerar_rotag.php");
}//ultima query
} // while rotavend criada
}// fim do else ( else existe rota ou nao)
}//fecha isset


?>


</div>
</div></div>


 
<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var PK_codrotav = $(this).attr("id");  
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{PK_codrotav:PK_codrotav},  
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
                url:"rotageral_del_agend.php",  
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


</table>
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