<?php
ini_set( 'display_errors', 0 );
if($_SESSION['niveluser'] == 'supervisor'){
header('location: ../supervisor/index.php');
}elseif($_SESSION['niveluser'] == 'admin'){
header('location: ../admin/index.php');

}elseif($_SESSION['niveluser'] == 'master'){
header('location: ../master/index.php');

}else{}

include_once('rotinha_pop.php');

?>
<nav class="navbar-default navbar-static-top" role="navigation">
<div class="navbar-header">
               
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
		           
		    		<li class="dropdown at-drop">
		              
		              <ul class="dropdown-menu menu1 " role="menu">
		                <li><a href="#">
		               
		                	<div class="user-new">
		                	<p>New user registered</p>
		                	<span>40 seconds ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-user-plus"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                	</a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>Someone special liked this</p>
		                	<span>3 minutes ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-heart"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>John cancelled the event</p>
		                	<span>4 hours ago</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-times"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>The server is status is stable</p>
		                	<span>yesterday at 08:30am</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-info"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p>New comments waiting approval</p>
		                	<span>Last Week</span>
		                	</div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-rss"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
		                <li><a href="#" class="view">Ver notificações</a></li>
		              </ul>
		            </li>

<li class="dropdown" class="descer" style="margin-top: 20px; margin-right: 30px;">
              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class="name-caret"><?=$_SESSION['username']?><i class="caret"></i></span></a>
              <ul class="dropdown-menu " role="menu">
              	<li><a href="agendamentos_vend.php"><i class="fa fa-envelope"></i>Agendamentos</a></li>
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
	  
		    
        </nav>