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
?>



<div id="page-wrapper" class="gray-bg dashbard-1">

<div class="content-main">
<div class="table-responsive">
<center>
<a href="lista_area.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br>
<table class="greyGridTable" >
<thead>
<tr>
<th>#</th>
<th>Area</th>
<th>Periodo</th>
<th>&darr;</th>

</tr>
</thead>
<tbody>
 <?php

$sqll =mysqli_query($conexao, "SELECT * from area_bloq GROUP BY periodo, FK_nomerota");
$cont = mysqli_num_rows($sqll);
if($cont > 0 ){
while ($dd = mysqli_fetch_assoc($sqll)){
$PK_codarea_bloq = $dd['PK_codarea_bloq'];
$FK_nomerota = $dd['FK_nomerota'];
$inidate = $dd['inidate'];
$fimdate_ = $dd['fimdate'];
$periodo = $dd['periodo'];
//data atual

$hoje = date('Y=m-d');


echo'
<tr>
<td>'.$PK_codarea_bloq.'</td>
<td>'.$FK_nomerota.'</td>
<td>'.$periodo.'</td>
<td>
 <button type="button" style="width:140px;" name="view" id="'.$PK_codarea_bloq.','.$FK_nomerota.','.$inidate.','.$fimdate_.','.$periodo.'" class="btn btn-primary btn-sm view_data" >
Excluir Bloqueio
 </button>


<!-- modal aqui -->
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Tem certeza que deseja apagar esse bloqueio?</h4>  

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
echo'</td>';

}//while

date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['apagar'])){

//puxa do modal
$PK_codarea_bloq = $_POST['PK_codarea_bloq'];
$FK_nomerota = $_POST['FK_nomerota'];
$inidate = $_POST['inidate'];
$fimdate =$_POST['fimdate'];
$periodo = $_POST['periodo'];


//transforma as variaveis em date
$data_inicial = new DateTime($inidate);
$data_final   = new DateTime($fimdate);


//formataçao de datas
$dt = $data_inicial->format( 'd-m-Y' );
$dt2 = $data_final->format( 'd-m-Y' );
$periodo_bd = $dt.' até '.$dt2;
$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$nomeuser = $_SESSION['username'];

//formataçao de datas
while( $data_inicial <= $data_final ){
 $data_inicial->format( 'd/m/Y' ) . '<br />' . PHP_EOL;
$datas[] = $data_inicial->format( 'Y-m-d' );
$data_inicial->add( DateInterval::createFromDateString( '1 days' ) );
}



for ($i=0; $i<count($datas); $i++) { 
// procura as rotas que estao bloqueadas
$select1 = mysqli_query($conexao, "SELECT * from rotavend where FK_datarg='$datas[$i]' and FK_nomerota = '$FK_nomerota'");
while ($dados1 = mysqli_fetch_assoc($select1)){
 $PK_codrotav = $dados1['PK_codrotav'];
//remove o bloqueio das rotas
$update1 = mysqli_query($conexao, "UPDATE rotavend set bloqueado=0 where PK_codrotav='$PK_codrotav'");

// deleta a area bloqueada
$delete1 = mysqli_query($conexao, "DELETE from area_bloq where  FK_nomerota='$FK_nomerota' and data='$datas[$i]'");

}//while
}//for

$descricao = " deletou o bloqueio da área ".$FK_nomerota." que durava de ".$periodo_bd;

$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");



// termina aqui
if($delete1 == true){
echo '<div class="alert alert-success">
Área '.$FK_nomerota.' deletada com sucesso! </div>';
    header("Refresh: 2; url=bloqueio_lista.php");
}else{
  echo '<div class="alert alert-danger">
Ocorreu um erro ao apagar esse bloqueio. </div>';
}

// header("Refresh: 1; url=bloqueio_lista.php");
}//isset
}else{
  echo 'Não possui nenhum bloqueio ainda.';
}
?>


</div>
</tbody>
</table>
</center>


<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var PK_codarea_bloq = $(this).attr("id");  
           $.ajax({  
                url:"apaga_modal.php",  
                method:"post",  
                data:{PK_codarea_bloq:PK_codarea_bloq
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

