<?php
include_once '../../control/manterLogin.php';
verificaUsuario();
include_once '../cabecalho.php';
include_once '../../model/Usuario.php';
include_once '../../control/conexao.php';
include_once '../../control/UsuarioDao.php';
// includes the start of the div and the message from the DAO file
include_once 'mensagem.php';

?>
<script language="Javascript">
//confirm registration exclusion
function confirmacao(id) {
     var resposta = confirm("Deseja remover esse registro?");
 
     if (resposta == true) {
          window.location.href = "excluir.php?id="+id;
     }
}
</script>



<div id="container">
	<div id="demo">
		<table cellpadding="0" cellspacing="0" border="0" class="col-md-12 col-md-offset-0 text-center ts-intro"
			id="example">
			<thead>
				<tr>
					<th></th>
					<th>Nome</th>
					<th>Login</th>
					<th>Cadastro</th>
					<th>Ações</th>
				</tr>
			</thead>	
				
					<?php
    $usuarioDao = new UsuarioDao($conexao);
    $usuarios = $usuarioDao->listaUsuarios();
    foreach ($usuarios as $usuario) :
        ?>
				   <tr id="3" class="gradeK">
				<td width="5%"><?php if($usuario->getAtivo() == 0){?><img
					src="../images/accept.png" title="ativo"><?php  }else{?><img
					src="../images/remove.png" title="inativo"><?php } ?></td>
				<td><?php echo $usuario->getNome()?></td>
				<td><?php echo $usuario->getLogin()?></td>
				<td><?php echo $usuarioDao->ajustarData($usuario->getDate())?></td>
				<td width="15%"><a
					href="editar.php?id=<?php  echo base64_encode($usuario->getId()) ?>"><img
						src="../images/user_edit.png" title="Editar"></a> <a
					href="javascript:func()"
					onclick="confirmacao('<?php echo base64_encode($usuario->getId().'|'.$usuario->getLogin()) ?>')"><img
						src="../images/user_remove.png" title="Excluir"></a></td>
			</tr>
				   <?php
    endforeach
    ?>
					
				
				<tfoot>
				<tr>
					<th></th>
					<th>Nome</th>
					<th>Login</th>
					<th>Cadastro</th>
					<th>Ações</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<br />
</div>
</div>



<?php

include_once '../rodape2.php';
?>

