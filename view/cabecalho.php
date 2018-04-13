<html class="no-js">
<?

?>
<head>
<!-- HTML 4 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- HTML5 -->
<meta charset="utf-8" />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Benfeitoria</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" />

<!-- layout / bootstrap -->
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/icomoon.css">

<link rel="stylesheet" href="../css/owl.carousel.min.css">
<link rel="stylesheet" href="../css/owl.theme.default.min.css">

<link rel="stylesheet" href="../css/style.css">
<script src="../js/modernizr-2.6.2.min.js"></script>
<!--[if lt IE 9]>
	<script src="../js/respond.min.js"></script>
	<![end]-->


<!-- lib datatables -->
<style type="text/css" title="currentStyle">
@import "../css/demo_table.css";
@import "../css/demo_page.css";

#linha {
  width: 100%;
  border-bottom: 1px solid #000000;
}

/* mobile phone */
@media all and (max-width: 768px) {
    #divContent{
     overflow:auto; 
    }
}
</style>
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.jeditable.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				/* Init DataTables */
				
				var oTable = $('#example').dataTable({
					
					"sScrollXInner": "110%",
					"bScrollCollapse": true
				});
				
				/* Apply the jEditable handlers to the table */
				//$('td', oTable.fnGetNodes()).editable( '../examples_support/editable_ajax.php', {
				$('', oTable.fnGetNodes()).editable( '../examples_support/editable_ajax.php', {
					"callback": function( sValue, y ) {
						var aPos = oTable.fnGetPosition( this );
						oTable.fnUpdate( sValue, aPos[0], aPos[1] );
					},
					"submitdata": function ( value, settings ) {
						return {
							"row_id": this.parentNode.getAttribute('id'),
							"column": oTable.fnGetPosition( this )[2]
						};
					},
					"height": "14px"
				} );
			} );
		</script>
<!--end datatables -->


<!-- lib Morris charts -->
  <script src="../js/raphael-min.js"></script>
  <script src="../js/morris.js"></script>
  <script src="../js/prettify.min.js"></script>
  <script src="../js/example.js"></script>
  <link rel="stylesheet" href="../css/example.css">
  <link rel="stylesheet" href="../css/prettify.min.css">
  <link rel="stylesheet" href="../css/morris.css">
<!-- end lib --> 


</head>



<body class="boxed">

	<!-- Loader -->
	<div class="fh5co-loader"></div>

	<div id="wrap">

		<div id="fh5co-page">
			<header id="fh5co-header" role="banner">
			<div class="container">
				<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i>
				</a>
				<div id="fh5co-logo">
					<a href="index.php"><img src="../images/benfeitoria.png"
						alt="Free HTML5 Website Template"> </a>
				</div>
				<nav id="fh5co-main-nav" role="navigation">
				<ul>
					<li><a href="../textos/index.php">Home</a></li>
					<li class="has-sub">
						<div class="drop-down-menu">
							<a href="#">Notícias</a>
							
							<div class="dropdown-menu-wrap">
								<ul>
									<li><a href="../textos/cadastrar.php">Cadastrar</a></li>
									<li><a href="../textos/gerenciar.php">Gerenciar</a></li>
									
									
								</ul>
							</div>
						</div>
					</li>
					
					<li class="has-sub">
						<div class="drop-down-menu">
							<a href="../usuarios/index.php">Usuário</a>
							<div class="dropdown-menu-wrap">
								<ul>
									<li><a href="../usuarios/cadastrar.php">Cadastrar</a></li>
									<li><a href="../usuarios/gerenciar.php">Gerenciar</a></li>


								</ul>
							</div>
						</div>
					</li>
<li class="btn btn-danger"><a href="../usuarios/login.php"><font color="white">Login</font></a></li>
				</ul>
				</nav>
			</div>
			</header>
			<!-- Header -->
			