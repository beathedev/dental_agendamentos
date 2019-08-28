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
<meta name="keywords" content="n" />
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

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
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
            <div class="table-responsive">

<center>
    
<div class="form-inline">
<form method="POST" action="">
  <h3>Bloqueio de data</h3>
  <br>
<label> Data Inicial do bloqueio:</label>

<input type="date" class="form-control" id="exampleInputEmail1" name="inidate" style="width:132px;font-size:15px;">
<br/>
<br/>
<label> Bloqueio termina em:</label>
<input type="date" class="form-control" id="exampleInputEmail1" name="fimdate" style="width:132px;font-size:15px;">
<br/><br>
<input type="submit" name="bloquear_data" class="btn btn-default" value="Bloquear"/>
</form><br><br>
</div>
<?php
if(isset($_POST['bloquear_data'])){
$inidate = $_POST['inidate'];
$fimdate = $_POST['fimdate'];
$periodo =  $inidate.' até '.$fimdate;
$data_inicial = new DateTime($inidate);
$data_final   = new DateTime($fimdate);

while( $data_inicial < $data_final ){
 $data_inicial->format( 'd/m/Y' ) . '<br />' . PHP_EOL;
$arraya[] = $data_inicial->format( 'Y-m-d' );
$data_inicial->add( DateInterval::createFromDateString( '1 days' ) );
}

$i = 0;

for ($i=0; $i<count($arraya); $i++) { 

$insert = mysqli_query(
  $conexao, "INSERT INTO datas_bloq(data, periodo, datafinal) VALUES ('$arraya[$i]', '$periodo', '$fimdate')");

$verifica = "SELECT * FROM rotavend where FK_datarg = '$arraya[$i]'";
$query_verifica = mysqli_query($conexao, $verifica);
$existe = mysqli_num_rows($query_verifica);


if($existe > 0){
  $update = mysqli_query($conexao, ("UPDATE rotavend set bloqueado = 1 where FK_datarg = '$arraya[$i]'"));

}else{


// cria rota geral
$sql_insere = "INSERT INTO rotageral(PK_datarg) VALUES ('$dataentrega')";
$result_insere = mysqli_query($conexao, $sql_insere);

// pega o nome das rotas ativas
$sql_consulta = "SELECT PK_nomerota from area WHERE status='1'";
$results = mysqli_query($conexao, $sql_consulta); 
while ($linhass = mysqli_fetch_array($results)) {
$PK_nomerota2 =$linhass['PK_nomerota'];//variavel com o nome de rotas ativas
$sql_inseree = "INSERT INTO rotavend(FK_datarg, FK_nomerota, bloqueado) VALUES ('$dataentrega', '$PK_nomerota2', 1)";
$result_inseree = mysqli_query($conexao, $sql_inseree);
}// area   

  $sql_consultaa = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
  $resultaa = mysqli_query($conexao, $sql_consultaa); 
  while($linhas = mysqli_fetch_array($resultaa)){ 
  $nomerota = $linhas['FK_nomerota'];
  $quantidadeagend = $linhas['quantidadeagend'];
  $quantidadeagend_total = $linhas['limiteagend'];
  $nomerota2 = $linhas['FK_nomerota'];
  $PK_nomerota3 = $linhass['PK_nomerota'];



}
}
}


if($insert == true){
echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Data bloqueada com sucesso!" readonly> 
      </div>';



}else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro, tente novamente..">
      </div>';
}



}
?>
<br/>
<table class="greyGridTable" >
<thead>
<tr>
<th>Data bloqueada</th>
<th>Excluir</th>
</tr>
</thead>

<tbody>
 <?php
 exibir_dados();

function exibir_dados(){
$conexao = mysqli_connect("localhost", "root", "", "projeto2test");
$sql = "SELECT *  from datas_bloq GROUP BY periodo order by coddatabloq DESC";
$query = mysqli_query($conexao, $sql);
while($linhas = mysqli_fetch_assoc($query)){
$datadestino = $linhas['data'];
$coddatabloq = $linhas['coddatabloq'];
$periodo = $linhas['periodo'];




echo ' 
<form method="POST" action="" id="dataDel">
<input type="hidden" name="PK_databloq" value="'.$PK_databloq.'" readonly="readonly">
<input type="hidden" name="datadestino" value="'.$datadestino.'" readonly="readonly">
<tr>
<td>'.$periodo.'</td>';
echo '
 <td>
<button type="button" name="view"  id="'.$coddatabloq.','.$periodo.','.$datadestino.'" class="btn btn-default view_data" />

<h5><span class="glyphicon" style="color:#0FA791;font-size:15px;">&#xe020</span>Apagar</h5> 
</button></td>




 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Você está prestes a apagar um bloqueio de data, continuar?</h4>  

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

echo '</form>';

echo'</tr>';
}
}

if(isset($_POST['apaga'])){
$coddatabloq = $_POST['cod'];
$periodo = $_POST['periodo'];
$datadestino = $_POST['datadestino'];

$sqll = "SELECT * from datas_bloq where periodo = '$periodo'";
$queryy = mysqli_query($conexao, $sqll);
while ($l = mysqli_fetch_assoc($queryy)) {
 $coddatabloq2 = $l['coddatabloq'];
 $data = $l['data'];

$update_1 = "UPDATE rotavend set bloqueado = 0 where FK_datarg='$data'";
$query_1 = mysqli_query($conexao, $update_1);



$delete_data = "DELETE FROM datas_bloq where coddatabloq = '$coddatabloq2'";
$query_delete_data = mysqli_query($conexao, $delete_data);
// header("Location: datas.php");
if($query_delete_data == true){
  header("location: datas.php");
}
}
}

 ?>

<!-- <button type="submit" name="excluir" onclick="funcao1()" class="btn btn-default btn-sm" style="border:none;background-color:#F3F3F4;">

 -->
</tbody>

</table>


<!-- <script>
function funcao1()
{
var x;
var r=confirm("Você está prestes a excluir um bloqueio de data!\nDeseja mesmo fazer isso?");
if (r==true)
  {
  form=document.getElementById('dataDel');
  form.target='';
  form.action='datas_del.php';
  form.submit();
  }
else
  {
  }
}
</script> -->

<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var coddatabloq = $(this).attr("id");  
           $.ajax({  
                url:"datas_del.php",  
                method:"post",  
                data:{coddatabloq:coddatabloq},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 }); 
</script>
</center>











</div>
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

