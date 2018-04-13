<?php
include_once '../../control/manterLogin.php';
verificaUsuario();
include_once '../cabecalho.php';
?>

<div class="row row-bottom-padded-md">
					<div class="col-md-8 col-md-offset-2 text-center ts-intro">
					
						
						<h1><?php echo $_SESSION['login']. $_SESSION['success'];?></h1>
						
						<p><a href="logout.php"><img src="../images/user_remove2.png"><br />(Logout)</a></p>
						
					</div>
				</div>
				</div>


</div>
<?php
include_once '../rodape.php';
?>

