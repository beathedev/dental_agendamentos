<?php
	include_once("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
if(isset($_POST['bloquear_rotinha']))
{
 $data_rota = $_POST['DATADAROTINHA'];
$update = mysqli_query($conexao, "UPDATE rotinha set block = 1 where FK_datarg='$data_rota'");
if($update == true)
{
	header('Location: rotinhas.php');

}


}


if(isset($_POST['desbloquear_rotinha']))
{
 $data_rota = $_POST['DATADAROTINHA'];
$update = mysqli_query($conexao, "UPDATE rotinha set block = 0 where FK_datarg='$data_rota'");
if($update == true)
{
	header('Location: rotinhas.php');

}


}


?>