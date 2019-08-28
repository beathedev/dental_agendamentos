<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
include_once("../conexao.php");
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
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
<style type="text/css">
input[type=number]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}
   input[type=number] { 
   -moz-appearance: textfield;
   appearance: textfield;
   margin: 0; 
}
    


    
</style>
<script src="js/skycons.js"></script></head>
<body>
<style type="text/css">
  

   table.greyGridTable {


  width: 100%;
  text-align: center;
  border-collapse: collapse;

}
    #oi{
        color: black;
    }
table.greyGridTable td, table.greyGridTable th {
/*  border: 1px solid #FFFFFF;
*/  padding: 3px 4px;
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
  border-bottom: 1px solid black;
/*  border-bottom: 1px solid #333333;
*/}

table.greyGridTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  border-top: 4px solid #333333;
}
table.greyGridTable tfoot td {
  font-size: 14px;
}


}

</style>       
<div id="wrapper">
<?php
include_once('menu.php');
include_once('../graficos.php');
$i= 0;
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
  $a = date($data_rota);
  $dia_seguinte=0;
  $data_termino = new DateTime($data_rota);
  $data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
  $data_rota=$data_termino->format("Y-m-d");
  $data_rota_layout=$data_termino->format('d-m-Y');
}
}
?>

        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
<center><input type="date" name="data_rota"  value="<?=$data_rota?>" readonly><br>

<table class="greyGridTable" > 


<?php

$sqll = "SELECT * from area where status = 1 ORDER BY PK_nomerota ASC";
$result_sqll = mysqli_query($conexao, $sqll); 
while($rota = mysqli_fetch_array($result_sqll)){
 $PK_nomerota = $rota['PK_nomerota'];

$sql_consulta2 = "SELECT * from rotavend where FK_datarg = '$data_rota' and FK_nomerota='$PK_nomerota' ORDER BY FK_nomerota ASC";
$result2 = mysqli_query($conexao, $sql_consulta2); 
while($linhas = mysqli_fetch_array($result2)){
$PK_codrotav = $linhas['PK_codrotav'];
$nomerota = $linhas['FK_nomerota'];
$quantidadeagend = $linhas['quantidadeagend'];
$limiteagend = $linhas['limiteagend'];
$contap = 100 / $limiteagend;
$conta = $contap * $quantidadeagend;

echo'
<thead>
<tr class="nomerota">
<th colspan="100%">
</th>
</tr>
<thead>
<tr>
<th>Rota</th>
<th>Limite de Agend.</th>
<th></th>
</tr>
</thead>
<form method="POST">';
echo'<td>'.$nomerota.'
</td>
<td><input type="hidden" value="'.$PK_codrotav.'" name="PK_codrotav">
'.$limiteagend.' <label>Nova quantidade:
<input type="number" name="nova_qntd" class="form-control" placeholder="Digite o nº do limite"></label>
</td>
<td><input type="submit" value="Salvar" class="btn btn-default" name="salvar"></td>
 </form>
';


}
}
if(isset($_POST['salvar'])){
     $PK_codrotav = $_POST['PK_codrotav'];
     $nova_qntd = $_POST['nova_qntd'];
    $upd ="UPDATE rotavend set limiteagend = '$nova_qntd' where PK_codrotav='$PK_codrotav'";
    $query_upd = mysqli_query($conexao, $upd);
    if($query_upd == true){

    echo  ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Alteraçao concluída com sucesso!" readonly> 
      </div>';
    }else{
        echo '    <div class="form-group has-error">
        <input type="text" class="form-control1"  style="width:500px; text-align:center;" id="inputError1" value="Alteração Não Concluida, Tente Novamente." readonly>
      </div>';
    }

}

?>
</table>
</center>
 <br> <br> <br>
 <br> <br> <br> 
 <br> <br>
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
    <div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de TI</p>
        </div>
    <div class="clearfix"> </div>
        </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"> </script>
</body>
</html>