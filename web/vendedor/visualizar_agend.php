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
<title>Dental MV - Vendedor</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords"/>
  <!--
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
    $("#calendario").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>
-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/tabela.css" rel="stylesheet"> 
<link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
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
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-4').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-5').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-6').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });  
            $('#demo-pie-7').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            }); 
            $('#demo-pie-8').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-9').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-10').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });                       
            $('#demo-pie-11').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-12').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });   

        });


    </script>
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
include_once('menu_vendedor.php');
?>
<?php
$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
?>


        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">

         <div class="content-main">
<center>
<a href="meusagends.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 
<?php
if(isset($_POST['visualizar'])){

$PK_codagend = $_POST['PK_codagend'];
$FK_coduser= $_SESSION['coduser'];
$FK_codrotav = $_POST['FK_codrotav'];
$obs = $_POST['obs'];
$status = $_POST['status'];
$dataabertura = $_POST['dataabertura'];
$dataentrega = $_POST['dataentrega'];
#$turno = $_POST['turno'];
$volume = $_POST['volume'];
$cliente = $_POST['cliente'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
#$quantidade = $_POST['quantidade'];
#$cf = $_POST['cf'];
$nomevendedor = $_POST['nomevendedor'];

//puxa o codigo da rota v:
$sql_area = "SELECT * from agend where PK_codagend = '$PK_codagend'";
$resultado = mysqli_query($conexao, $sql_area);
while($rows = mysqli_fetch_assoc($resultado)){
$FK_codrotav = $rows['FK_codrotav'];
}
//puxa a area:
$sql_area2 = "SELECT * from rotavend where PK_codrotav = '$FK_codrotav'";
$resultado2 = mysqli_query($conexao, $sql_area2);
while($rows2 = mysqli_fetch_assoc($resultado2)){
$FK_nomerota = $rows2['FK_nomerota'];
}



// tabelona
echo '

<form action="edit_agend.php" method="POST">
<table class="table table-striped">
<input type="text" name="area" value="'.$FK_nomerota.'" style="width:200px;font-size:px" readonly="readonly">


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

</tr>
</thead>

';
//fim do head da tabela


//corpo da tabela
echo'
<tbody>
<tr>
';

//campo volume
if($volume == 0){
echo '<td><input type="hidden" name="volume" value="'.$volume.'">
 N/
<br><br>

</td>';
}  
else{
echo '
<input type="hidden" name="volume" value="'.$volume.'">
<td style="background-color:black;width:1px;">

</td>';
}


//continuaçao do corpo da tabela
echo'
<input type="hidden" name="FK_codrotav" value="'.$FK_codrotav.'">
<td><input type="text" name="PK_codagend" value="'.$PK_codagend.'" style="width:25px;" readonly="readonly"></td>
<td><input type="text" name="nomevendedor" value="'.$nomevendedor.'" style="width:120px;" readonly="readonly"></td>
<td><textarea  style="width:138px;height:90px;" name="obs">'.$obs.'</textarea></td>';

//campo caixao

if($status == 1){
echo '<td><input type="hidden" value="1" name="status">Efetivado</td>';
}  
else{
echo '<td style="background-color:yellow;color:black;"><input type="hidden" value="0" name="status">Caixao</td>';
}


//continuaçao do corpo da tabela
echo '

<td>
<input type="text" name="dataabertura" style="width:100px;" value="'.$dataabertura.'" readonly="readonly">
</td>

<td>
<input type="text" name="dataentrega" style="width:100px;" value="'.$dataentrega.'">
</td>

<td>
<input type="text" name="cliente" style="width:120px;" value="'.$cliente.'">
</td>
<td>
<input type="text" name="endereco" style="width:120px;" value="'.$endereco.'">
</td>

<td>
<input type="text" name="bairro" style="width:90px;" value="'.$bairro.'">
  <br><br>
</td>


</tr>
</tbody>
</table>
<br>

';



$sql_consulta = "SELECT * from ped where FK_codagend = '$PK_codagend'";
$query = mysqli_query($conexao, $sql_consulta);
$rowcount=mysqli_num_rows($query);

while($linhas = mysqli_fetch_assoc($query)){
$PK_codped = $linhas['PK_codped'];
$FK_codagend = $linhas['FK_codagend'];
$pedidos = $linhas['pedidos'];
$valor = $linhas['valor'];
//tabela ped
echo'
<table class="table table-striped">
<thead>
<tr>
<th>Cod. Ped</th>
<th>Nº do Pedidos</th>
<th>Valor</th>
</thead>
<tbody>
<tr>
<td><input type="text" name="PK_codped" value="'.$PK_codped.'" style="width:25px;" readonly="readonly"></td>
<td><input type="text" name="pedidos"  value="'.$pedidos.'"></td>
<td><input type="text" name="valor" style="width:100px;" value="'.$valor.'"></td>
</tr>
</tbody>
</table>
';
}
echo '
<br>
<input type="submit" name="editar" class="btn btn-default" value="Editar">
</form>
';


}//fim do isset




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

