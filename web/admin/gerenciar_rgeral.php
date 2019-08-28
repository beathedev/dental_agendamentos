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

<!--pie-chart--->
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

?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
<?php
if(date('N') > 4 ){
    $data = new DateTime(date("Y-m-d"));
    $data->modify('+3 day');
    $data_rota=$data->format('Y-m-d');
    $data_rota_layout=$data->format('d/m/Y');
    }elseif(date('N') <= 4 ){
    $data = date ("Y-m-d");
    $inicio= $data;
    $dia_seguinte=1;
    $data_termino = new DateTime($inicio);
    $data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
    $data_rota=$data_termino->format("Y-m-d");
    $data_rota_layout=$data_termino->format('d/m/Y');
    } 
    $databangu = date("d/m/Y");

$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE data = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
   $datadestino = $result_data['datafinal'];

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
       <form action="" method="POST">
         <div class="content-main">

        <!--banner-->   
        <!--//banner-->
        <!--content-->
        <div class="content-top">
             <br> <br> <br>
        <center>           
        
       <a href="gerar_rotag.php" class="btn btn-lg btn-primary view-date1" style="width:300px;">Rota Geral <br/> <input type="hidden" class="form-control" id="" value="<?=$data_rota_layout?>" style="background-color:#337AB7; color:white; text-align:center;" READONLY="READONLY"> (<?=$data_rota_layout?>)</a>
       <a href="gerar_rotag2.php" class="btn btn-lg btn-default" style="width:300px;">Rota Geral <br/>  <input type="hidden" class="form-control" id="" value="<?=$databangu?>" style="background-color:#337AB7; color:white; text-align:center;" READONLY="READONLY"> (<?=$databangu?>)</a><br/><br/><br/>
       <a href="consult_rotag_1.php" class="btn btn-lg btn-default" style="width:300px;">Consulta de Rotas <br/> (OUTRAS DATAS) </a>
  </center>


 <br> <br> <br> <br>
 <br>
</center>
</div>

</form>
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

