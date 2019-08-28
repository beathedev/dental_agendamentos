<?php
ini_set( 'display_errors', 0 );
if($_SESSION['niveluser'] == 'vendedor'){
header('location: ../vendedor/index.php');
}elseif($_SESSION['niveluser'] == 'supervisor'){
header('location: ../supervisor/index.php');
}elseif($_SESSION['niveluser'] == 'administrador'){
header('location: ../admin/index.php');

}else{}

include_once('../master/rotinha_pop.php');
date_default_timezone_set('America/Sao_Paulo');
?>

        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<h1><a class="navbar-brand" href="index.php" style="background-image:url('../images/logo2.png');background-repeat: no-repeat;"></a></h1>        
   </div>
 <div class=" border-bottom">
          <div class="full-left">
            <section class="full-top">
</section>

            <div class="clearfix"> </div>
           </div>

    <div class="drop-men" >
        <ul class="nav_1">
           
    
<li class="dropdown" class="descer" style="margin-top: 20px; margin-right: 30px;">
              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class="name-caret"><?=$_SESSION['username']?><i class="caret"></i></span></a>
              <ul class="dropdown-menu " role="menu">
                                <li><a href="historico.php"><i class="fa fa-clipboard"></i>Histórico</a></li>

                <li><a href="?sair"><i class="fa fa-clipboard"></i>Sair</a></li>
                <?php
                if(isset($_GET['sair'])){
  session_destroy();
  session_unset(['coduser']);
  session_unset(['niveluser']);
  session_unset(['username']);
  session_unset(['senha']);
  header('location: ../index.php');
}
                ?>
              </ul>
            </li>
           
        </ul>
     </div><!-- /.navbar-collapse -->
<div class="clearfix">
       
     </div>

    <div class="navbar-default sidebar" role="navigation" >
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

  
                    <li>
                        <a href="agendamentos.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Agendamentos</span> </a>
                    </li>
                    <li>
                            <a href="areas.php" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Áreas</span> </a>
                    </li>
                    <li>
                        <a href="caixao.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Caixões</span> </a>
                    </li>
                    <li>
                        <a href="datas.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Datas</span> </a>
                    </li>
                    <li>
                        <a href="visualizar_rotas.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label"> Rotas</span> </a>
                    </li>
                    <li>
                        <a href="gerenciar_rgeral.php" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Rota Geral</span></a>
                    </li>
 <li>
                        <a href="cadastros.php" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Usuários</span> </a>
                    </li>
                    
                    
                    

                                   
                   
</div>
        </nav>