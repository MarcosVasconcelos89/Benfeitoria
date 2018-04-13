<?php
include_once '../../control/manterLogin.php';
verificaUsuario();
include_once '../cabecalho.php';
include_once '../../model/Usuario.php';
include_once '../../model/Texto.php';
include_once '../../control/conexao.php';
include_once '../../control/UsuarioDao.php';
include_once '../../control/textoDao.php';

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
		<table cellpadding="0" cellspacing="0" border="0"
			class="col-md-12 col-md-offset-0 text-center ts-intro" id="example">
			<thead>
				<tr>
					<th></th>
					<th>Id</th>
					<th>Título</th>
					<th>Criador</th>
					<th>Data</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
    $textoDao = new TextoDao($conexao);
    $textos = $textoDao->listaTextos();
    foreach ($textos as $texto) :
        ?>
				   <tr id="3" class="gradeK">
					<td width="5%"><?php if($texto->getPublicado() == 0){?><img
						src="../images/accept.png" title="ativo"><?php  }else{?><img
						src="../images/remove.png" title="ativo"><?php } ?></td>
					<td><?php echo $texto->getId(); ?></td>
					<td><?php echo $textoDao->ajustarTitulo($texto->getTitulo()) ;?></td>
					<td><?php echo $texto->getUsuario()->getLogin(); ?></td>
					<td><?php echo $textoDao->ajustarData($texto->getCriacao());?></td>
					<td width="15%"><a
						href="ler.php?id=<?php  echo base64_encode($texto->getId()) ?>"><img
							src="../images/page_search.png" title="Ler"></a> <a
						href="editar.php?id=<?php  echo base64_encode($texto->getId()) ?>"><img
							src="../images/page_edit.png" title="Editar"></a> <a
						href="javascript:func()"
						onclick="confirmacao('<?php echo base64_encode($texto->getId().'|'.$texto->getTitulo()) ?>')"><img
							src="../images/page_remove.png" title="Excluir"></a></td>

				</tr>
				   <?php
    endforeach
    ;
    ?>
					
				</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th>Id</th>
					<th>Título</th>
					<th>Criador</th>
					<th>Data</th>
					<th>Ações</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<br />
<br />
<br />
<br />
<!-- chart bar

           <div class="col-md-12 col-md-offset6 text-center ts-intro">
            <div class="col-md-6">
            <h3>Mais Visitadas</h3>
            <div id="graph"></div>
            </div>
-->        

</div>

</div>

</div>
</div>

</div>
<script>
// Use Morris.Bar
Morris.Bar({
  element: 'graph',
  data: [
	  	
<?php
$textos = $textoDao->alimentaGraficoBarra();
foreach ($textos as $texto) :
    echo "{id:  '" . "Id " . $texto->getId() . "', leitores: " . $texto->getPrincipal() . "},";
endforeach
;
?>
  ],
  xkey: 'id',
  ykeys: ['leitores'],
  labels: ['leituras'],
  barColors: function (row, series, type) {
    if (type === 'bar') {
      var red = Math.ceil(255 * row.y / this.ymax);
      return 'rgb(' + red + ',0,0)';
    }
    else {
      return '#000';
    }
  }
});


</script>
<?php include_once '../rodape2.php';?>

