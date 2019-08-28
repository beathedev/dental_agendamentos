<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
  }include_once("../conexao.php");

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
<meta name="keywords" content="" />
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
$dataentrega = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');

}
    // ... validações, inserts, updates, etc...
?>
<?php

if(isset($_POST['enviar'])){
$dataentrega = $_POST['dataentrega'];
$sql = "SELECT `quantidadeagend` FROM `rotavend` WHERE `FK_datarg` = '$dataentrega'";
$result = mysqli_query($conexao, $sql); // Realiza Query
while($linhas = mysqli_fetch_assoc($result)){
$quantidadeagend = $linhas['quantidadeagend'];


$array = explode(',', $quantidadeagend);
var_dump($array);


}
}

 ?>

        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">	


		
       <form action="agendamento.php" method="POST">
         <div class="content-main">

 <center><h3>Selecione uma Data e uma Área:</h3><br><input type="date" name="dataentrega" value="<?=$dataentrega?>" readonly></center>
		<!--banner-->	
		<!--//banner-->
		<!--content-->
		<div class="content-top">
			<div class="col-md-6 ">
				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5 name="baixada">Baixada <input type="radio" name="area" value="baixada"/></h5>
				</div>

				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-1" class="pie-title-center" data-percent="25"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
		

				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Barra-Recreio-JPA <input type="radio" name="area" value="barrarecreiojpa"/></h5>
					
				</div>

	
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-2" class="pie-title-center" data-percent="50"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>


				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Centro <input type="radio" name="area" value="centro"/></h5>
					
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>


				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Bangu <input type="radio" name="area" value="bangu" /></h5>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-4" class="pie-title-center" data-percent="25"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
								<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Niterói-Ilha <input type="radio" name="area" value="niteroi-ilha"/></h5>
					
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-6" class="pie-title-center" data-percent="25"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
			</div>
		

			<div class="col-md-6">
		




				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Norte A <input type="radio" name="area" value="nortea" /></h5>
				
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-7" class="pie-title-center" data-percent="50"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Norte B <input type="radio" name="area" value="norteb" /></h5>
				
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-8" class="pie-title-center" data-percent="50"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
			
				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Oeste <input type="radio" name="area" value="oeste"/></h5>
				
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-9" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>

				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Sul <input type="radio" name="area" value="sul" /></h5>
				
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-10" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>

			</div>
	

	


		



		<div class="clearfix"> </div>

					<center>
<br>
      <input type="submit"  name="enviar" class="btn btn-default" value="Criar">
    
      <input type="submit" class="btn btn-default" value="Consultar">

				</center>
		</div>
	</form>
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
<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>

