<?php
ob_start();
session_start();
if(isset($_SESSION['username']) && (isset($_SESSION['senha']))){



if($_SESSION['niveluser'] == 'vendedor'){
header('location: ../web/vendedor/index.php');

}elseif($_SESSION['niveluser'] == 'supervisor'){
header('location: ../web/supervisor/index.php');

}elseif($_SESSION['niveluser'] == 'administrador'){
header('location: ../web/admin/index.php');

}elseif(($_SESSION['niveluser'] == 'master')){
header('location: ../web/master/index.php');

}else{}
}
include_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Logar/Dental MV</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">
</head> 

<body>
    <header>
        <h1 class="title-agile text-center">Entre com sua conta:</h1>
    </header>
    <!-- //header -->
    <section class="login-wrap" style="background: url('images/dental_mv.png') no-repeat center;" >
        <div class="main_w3agile" >
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Preencha os Campos:</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab"></label>
            <div class="login-form">
                <!-- signin form -->
                <div class="signin_wthree">
                    <form method="POST" action="#">
                        <div class="group">
                            <label for="user" class="label">Usuário</label>
                            <input id="user" name="username" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Senha</label>
                            <input id="pass" name="senha" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <!--<label for="check">
                                <span class="icon"></span> Keep me Signed in</label>
                        </div> -->
                        <div class="group">
                            <input type="submit" name="entrar" class="button" value="Entrar">
                        </div>
                        <div class="hr"></div>
                        <!--<div class="foot-lnk">
                            <h2><a href="#">Forgot Password?</a></h2>
                        </div>-->

                        <?php
                        if(isset($_POST['entrar'])){
                    
$username = mysqli_real_escape_string($conexao, $_POST['username']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$ativado = 1;
$pesquisar = "SELECT * FROM usuario WHERE username='$username' AND senha='$senha' AND status='$ativado'";
$resultado = mysqli_query($conexao, $pesquisar); 
$linhas = mysqli_fetch_assoc($resultado); 

if($linhas > 0){
$_SESSION['coduser'] = $linhas['PK_coduser'];
$_SESSION['niveluser'] = $linhas['niveluser'];
$_SESSION['username'] = $linhas['username'];
$_SESSION['senha'] = $linhas['senha'];

// Se o nivel do usuário for igual a 0, ele será redirecionado a pagina de Vendedor.
if($_SESSION['niveluser'] == 'vendedor' ){
header("Location: vendedor/index.php");
}
// Se o nivel do usuário for igual a 1, ele será redirecionado a pagina de Supervisor.
elseif($_SESSION['niveluser'] == 'supervisor' ){ 
header("Location: supervisor/index.php");
}

// Se o nivel do usuário for igual a 2, ele será redirecionado a pagina de Admin.
elseif($_SESSION['niveluser'] == 'administrador' ){ 
header("Location: admin/index.php");

// Se o nivel do usuário for igual a 3, ele será redirecionado a pagina de Master.
}elseif(($_SESSION['niveluser'] ==  'master')){
 header("Location: master/index.php");
   
}elseif(($_SESSION['niveluser'] ==  'supervisor-adm')){
 header("Location: supervisor2/index.php");

}
// Quando o usuário nao for encontrado durante a query, ele recebera a mensagem: 
}else{
echo '
<center><p style="background-color:#FDE5E5;border:1px solid #C42729;color:#C42729;font-size:22px;border-radius:4px;padding:3px;">Usuário nao encontrado, tente novamente.</center>';
unset ($_POST['username']);
unset ($_POST['senha']);
}

}

?>
                    </form>
                </div>
                <!-- //signin form -->
                <!-- signup form -->
           
                <!-- //signup form -->
            </div>
        </div>
    </section>
    <!-- //section -->
    <footer>
    </footer>
    <!-- //footer -->
    <!-- script for password match -->
    <script>
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
</body>
<!-- //Body -->

</html