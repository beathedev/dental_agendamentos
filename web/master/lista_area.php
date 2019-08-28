<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
  header('location: ../login.php');
}
    include_once("../conexao.php");
?>

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
function exibir_dados() {
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
}

$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$nomeuser = $_SESSION['username'];


?>



<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<div class="table-responsive">
<center>

<a href="bloqueio_lista.php" class="btn btn-default">Ver todos os bloqueios por período</a>



<a href="areas.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br>
<table class="greyGridTable" >
<thead>
<tr>
<th>#</th>
<th>Area</th>
<th>Status</th>
<th>Ativar/Inativar</th>
</tr>
</thead>
<tbody>
 <?php

$sql = "SELECT * from area ORDER BY PK_nomerota DESC";
$query = mysqli_query($conexao, $sql);

while($linhas = mysqli_fetch_assoc($query)){
 $PK_nomerota = $linhas['PK_nomerota'];
$codarea = $linhas['codarea'];
 $status = $linhas['status'];

echo '    
<form method="POST" id="formDel">
<tr>
<td><input type="text" name="codarea" value="'.$codarea.'" readonly="readonly"></td>
<td><input type="text" name="area" value="'.$PK_nomerota.'"   readonly="readonly"></td>
<td> ';


if($status == 0){
echo'Inativo';
}else{
echo'Ativada ';

}


$sqll =mysqli_query($conexao, "SELECT * from area_bloq where FK_nomerota = '$PK_nomerota'  GROUP BY `periodo`");
while ($dd = mysqli_fetch_assoc($sqll)){
$inidate = $dd['inidate'];
$fimdate_ = $dd['fimdate'];
$periodo = $dd['periodo'];


$data_inicial = new DateTime($inidate);
$data_final   = new DateTime($fimdate_);

  $dt = $data_inicial->format( 'd-m-Y' );
  $dt2 = $data_final->format( 'd-m-Y' );
  $periodo_format = $dt.' até '.$dt2;


//data atual
$hoje = date('Y=m-d');


// verifica se foi bloqueado por periodo
if($periodo != null and $fimdate_ <= $hoje){
echo  '( Inativ. Temporariamente durante:'.$periodo_format.')';
echo'<br><br>';

}
}//while








echo'</td>';

//aqui
if($status == 1){
echo '<td>  <input type="hidden" name="status" value="0" readonly="readonly">

<input type="button"  style="width:120px;" name="codarea" id="'.$codarea.','.$PK_nomerota.','.$status.'" class="btn btn-default btn-sm view_data3"  style="margin-top:9px;" value="Inativar">  ';



echo'


 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Inativar área</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>
';




echo'


 <input type="hidden"  name="status" value="0" readonly="readonly"> 
 <button type="button" style="width:140px;" name="view" id="'.$codarea.','.$PK_nomerota.'" class="btn btn-primary btn-sm view_data" >
 Inativar por periodo
 </button><br>

';





echo'


 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Inativar área por período</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>
';


}
else{


echo '<td> <input type="hidden" name="status" value="1" readonly="readonly"><input type="submit" name="enviar2" class="btn btn-sm btn-default" style="margin-top:9px;" value="Ativar">';


}

echo'</tr>';
echo '</td></form>';



}

if(isset($_POST['enviar2'])){
$status = $_POST['status'];
$FK_nomerota = $_POST['area'];
$codarea = $_POST['codarea'];

echo'
<form method="POST" id="formConfirm2">
<input type="text" name="codarea" value="'.$codarea.'" readonly="readonly">
<input type="text" name="area" value="'.$FK_nomerota.'" readonly="readonly">
<input type="text" name="status" value="'.$status.'" readonly="readonly">
</form>';

echo'
<script>

var x;
var r=confirm("Você está prestes a ativar uma área\n Deseja mesmo fazer isso?");
if (r==true)
  {
  form=document.getElementById("formConfirm2");
  form.target="";
  form.action="lista_area_up2.php";
  form.submit();
  }
</script>';




}
if(isset($_POST['enviar'])){
 $status = $_POST['status'];
$codarea = $_POST['codarea'];
$FK_nomerota = $_POST['area'];
//aq

$update = "UPDATE area set status=0 where codarea ='$codarea'";
$query = mysqli_query($conexao, $update);
//query
if($query > 0 ){
echo '<div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Alteração Concluída" readonly> 
      </div></center>';
           header("location: lista_area.php");

}else{
echo '    <div class="form-group has-error">
        <input type="text" class="form-control1"  style="width:500px; text-align:center;" id="inputError1" value="Alteração Não Concluida, Tente Novamente." readonly>
      </div>';
           header("location: lista_area.php");

     
}// fim query

$descricao = "inativou a área ".$FK_nomerota;
$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");



// }// fim else contador





}// fim isset








if(isset($_POST['block'])){

  $inidate = $_POST['inidate'];
  $fimdate = $_POST['fimdate'];
  $codarea = $_POST['codarea'];
  $FK_nomerota = $_POST['FK_nomerota'];
  $data_inicial = new DateTime($inidate);
  $data_final   = new DateTime($fimdate);

// periodo de dias
while( $data_inicial <= $data_final ) {
 $data_inicial->format( 'd/m/Y' ) . '<br />' . PHP_EOL;
$arraya[] = $data_inicial->format( 'Y-m-d' );
$data_inicial->add( DateInterval::createFromDateString( '1 days' ) );
}


for ($i=0; $i< count($arraya); $i++) {  
$periodo = $inidate.' até '.$fimdate;

//verifica se existe a rota na área e data selecionada
$consult1 = mysqli_query($conexao, "SELECT * FROM rotavend WHERE FK_datarg = '$arraya[$i]' and FK_nomerota='$FK_nomerota'");
$quantidade =  mysqli_num_rows($consult1);

// se EXISTIR ROTAV
if($quantidade > 0){
while($t1 = mysqli_fetch_assoc($consult1)){
$PK_codrotav = $t1['PK_codrotav'];
$consult2 = mysqli_query($conexao, "SELECT * FROM agend WHERE  dataentrega = '$arraya[$i]' and FK_codrotav='$PK_codrotav'");
$quantidade2 =  mysqli_num_rows($consult2);
}//while

// se EXISTIR AGEND
if($quantidade2 > 0){

while($t2 = mysqli_fetch_assoc($consult2)){
$FK_codrotav = $t2['FK_codrotav'];
$PK_codagend = $t2['PK_codagend'];
$FK_datarg = $t2['dataentrega'];

//formataçao pra exibir as datas em ././.
$FK_datarg_ = new DateTime($FK_datarg);
$FK_datarg2 = $FK_datarg_->format('d/m/Y');
}// while

echo'<div class="alert alert-warning">
  <strong>Está data: '.$FK_datarg2.'<BR> possui agendamentos!</strong><br> Clique no botão abaixo para trocar a data ou área dos agendamentos:<br><br>';
echo'<form action="agendamentos_troca.php" method="POST">';
echo '<input type="hidden"  name="datas"        value='.$FK_datarg2.'>';
echo '<input type="hidden"  name="PK_codagend"  value='.$PK_codagend.'>';
echo '<input type="hidden"  name="FK_codrotav"  value='.$FK_codrotav.'>';
echo $quantidade2.' agendamento(s) na data '.$FK_datarg2;
echo'&nbsp<button type="submit" name="alterar" class="btn btn-primary">Alterar</button><br><br>';
echo '</form>';

// se NAO EXISTIR AGEND
}else{

// bloqueia rota
$upd2 = mysqli_query($conexao, "UPDATE rotavend set bloqueado = 1 WHERE PK_codrotav='$PK_codrotav'");
//insere o bloqueio




$periodo = $inidate.' até '.$fimdate;


$insert2 = mysqli_query($conexao, "INSERT INTO area_bloq(FK_nomerota,data,periodo, inidate, fimdate) VALUES ('$FK_nomerota','$arraya[$i]','$periodo', '$inidate', '$fimdate')");

$dt = $data_inicial->format( 'd-m-Y' );
$dt2 = $data_final->format( 'd-m-Y' );
$periodo_bd = $dt.' até '.$dt2;



$descricao = "inseriu um bloqueio na área ".$FK_nomerota." que dura de ".$periodo_bd;
$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui



}//fim if agend

// SE NAO EXISTIR ROTA 
}else{

// cria rota geral
$sql_insere = "INSERT INTO rotageral(PK_datarg) VALUES ('$arraya[$i]')";
$result_insere = mysqli_query($conexao, $sql_insere);

// pega o nome das rotas ativas
$sql_consulta = "SELECT PK_nomerota from area WHERE status='1'";
$results = mysqli_query($conexao, $sql_consulta); 
while ($linhass = mysqli_fetch_array($results)) {
 $PK_nomerota2 =$linhass['PK_nomerota'];//variavel com o nome de rotas ativas

$sql_inseree = "INSERT INTO rotavend(FK_datarg, FK_nomerota) VALUES ('$arraya[$i]', '$PK_nomerota2')";
$result_inseree = mysqli_query($conexao, $sql_inseree);
}// area  


$sql_consultaa = "SELECT * from rotavend where FK_datarg = '$arraya[$i]' and FK_nomerota='$FK_nomerota')";
$resultaa = mysqli_query($conexao, $sql_consultaa); 
while($t4 = mysqli_fetch_array($resultaa)){ 
$PK_codrotav_update = $t4['PK_codrotav'];




$upd3 = mysqli_query($conexao, "UPDATE rotavend set bloqueado = 1 WHERE PK_codrotav='$PK_codrotav_update'");
}// while rotavend
$periodo = $inidate.' até '.$fimdate;



$insert2_ =mysqli_query($conexao, "INSERT INTO area_bloq(FK_nomerota,data,periodo, inidate, fimdate) VALUES ('$FK_nomerota','$arraya[$i]','$periodo', '$inidate', '$fimdate')");
$dt = $data_inicial->format( 'd-m-Y' );
$dt2 = $data_final->format( 'd-m-Y' );
$periodo_bd = $dt.' até '.$dt2;



$descricao = " inseriu um bloqueio na área ".$FK_nomerota." que dura de ".$periodo_bd;
$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");

}// fim if rotav

ECHO'</div>';
ECHO'</div>';
}//for


$periodo = $inidate.' até '.$fimdate;
$selectt = mysqli_query($conexao, "SELECT * from area_bloq where periodo='$periodo'");
$numrows = mysqli_num_rows($selectt);

while ($data = mysqli_fetch_assoc($selectt)) {

$inicio = $data['inidate'];
$fim = $data['fimdate'];

$data_ini = new datetime ($inicio);
$data_fim = new datetime ($fim);



$começa = $data_ini->format( 'd-m-Y' );
$termina = $data_fim->format( 'd-m-Y' );

}
if($numrows > 0){
echo '<div class="alert alert-success">
Área '.$FK_nomerota.' Bloqueada com sucesso de '.$começa.' até '.$termina.'</div>';

}else{

}


}//isset






?>



</div>
</tbody>
</table>
</center>


<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var codarea = $(this).attr("id");  
           $.ajax({  
                url:"modal_area.php",  
                method:"post",  
                data:{codarea:codarea
                      },  
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
      $('.view_data3').click(function(){  
           var codarea = $(this).attr("id");  
           $.ajax({  
                url:"lista_area_up.php",  
                method:"post",  
                data:{codarea:codarea
                      },  
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
           var PK_codrotav = $(this).attr("id");  
           $.ajax({  
                url:"modal_area_alterar.php",  
                method:"post",  
                data:{PK_codrotav:PK_codrotav
                      },  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 }); 
</script>

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

