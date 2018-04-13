<?php
session_start();
if(isset($_SESSION['login'])){
    $redirect = "../usuarios/bem_vindo.php";
    echo $_SESSION['login'];
    
    header("location:$redirect");
}
include_once '../cabecalho.php';
include_once 'mensagem.php';
?>

<div class="row">
		<div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 user-image-section">
					<img src="../images/user128.png">
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
					<div class="form-group">
					<br />
					
					<form action="logar.php" name="mensagemEnvio" method="POST"
			enctype="multipart/form-data">
			<div class="form-group">
				<table>
					
					<tr>
						<td><label for="email">Login:</label></td>
						<td><input type="text" maxlength="20" class="form-control"
							id="name" name="login" placeholder="Informe um login."
							data-error="Por favor, informe seu login." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td><label for="email">Senha:</label></td>
						<td><input type="password" maxlength="12" class="form-control"
							id="name" name="senha" placeholder="Informe uma senha."
							data-error="Por favor, informe sua senha." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td></td>
						<td><br />
							<button type="submit" class="btn btn-danger">Logar</button></td>
					</tr>
				</table>
			</div>
		</form>
					
					
					
					
					
				</div>
				</div>
			</div>
		</div>
	</div></div></div>
<?php 
include_once '../rodape.php';
?>