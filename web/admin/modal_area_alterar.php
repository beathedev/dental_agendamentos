<?php
$array = $_POST['PK_codrotav'];

$explode = explode(',', $array);
$PK_codrotav = $explode[0];
 $datas_agendamentos = $explode[1];


?>


<center>
<form method="POST" action="lista_area.php">
<h5> Datas que possuem agendamento:</h5>
<br>
<?php
echo $datas_agendamentos;

?>



