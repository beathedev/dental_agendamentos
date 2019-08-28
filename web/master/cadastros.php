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

       <form action="" method="POST">
         <div class="content-main">
 		
  		<!--banner-->	
		<!--//banner-->
		<!--content-->
		<div class="content-top">
             <br> <br> <br>
		<center>	       

	   <a href="lista_usu.php" class="btn btn-lg btn-default" style="width:198px;"> Lista de Usuários </a>
      <a href="cadastrar_usu.php" class="btn btn-lg btn-default" style="width:198px;"> Cadastrar Usuários </a>
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
     </div>	</div>
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

