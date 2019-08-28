<?php
$servidor = "127.0.0.1"; /*maquina a qual o banco de dados está*/
$usuario = "root"; /*usuario do banco de dados MySql*/
$senha = ""; /*senha do banco de dados MySql*/
$banco = "projeto2test"; /*seleciona o banco a ser usado*/
$conexao = mysqli_connect('127.0.0.1','root',''); /*Conecta no bando de dados MySql*/
mysqli_select_db($conexao, "projeto2test");; /*seleciona o banco a ser usado*/	
	?>
	