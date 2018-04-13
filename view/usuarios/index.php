<?php
include_once '../cabecalho.php';
?>

<form action="adiciona.php" name="mensagemEnvio" method="POST" enctype="multipart/form-data">
		<div class="form-group">
		<table>
		
		<tr> 
		<td><label for="email">Login:</label></td>
		<td><input type="text"
						class="form-control" id="name" name="nome" placeholder="Enter  name message"
						data-error="Por favor, informe seu nome." required>
			<div class="help-block with-errors"></div></td>
		</tr>
		<tr> 
		<td><label for="email">Senha:</label></td>
		<td><input type="text"
						class="form-control" id="name" name="nome" placeholder="Enter  name message"
						data-error="Por favor, informe seu nome." required>
			<div class="help-block with-errors"></div></td>
		</tr>
		
		
		
		<tr>
		<td></td>
		<td><br/><button type="submit" class="btn btn-danger" >Submit</button></td>
		</tr>
		</table>
						
						
				
		</div>

		 
	</form>

<?php 
include_once '../rodape.php';