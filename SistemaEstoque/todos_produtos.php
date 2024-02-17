<?php
	$acao = 'recuperar';
	require 'produto_controller.php';
	/*echo '<pre>';
	print_r($produtos);
	echo '</pre>';*/

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sistema de gerencimento de estoque</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script src="index.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Sistema de gerencimento de estoque
				</a>
			</div>
			<ul class="navbar-nav">
				<li class="nav-item">
				<a class="nav-link" href="logoff.php">SAIR</a>
				</li>
			</ul>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="produtos_disponiveis.php">Produtos disponíveis</a></li>
						<li class="list-group-item"><a href="novo_produto.php">Novo produto</a></li>
						<li class="list-group-item active"><a href="#">Todos produtos</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todos produtos</h4>
								<hr />
								<!--Lista e filtra informações-->
								<?php foreach($produtos as $indice => $produto) { ?>
										<!--Apenas o ADM tem acesso a tudo-->
										<?php if(isset($_SESSION['perfil_id'])) { ?>
										<?php if($_SESSION['perfil_id'] == 1 ) { ?>
											<div class="row mb-3 d-flex align-items-center produto">
												<div class="col-sm-9" id="produto_<?= $produto->id_produto ?>">
													<?= $produto->nome ?> (<?= $produto->status ?>)
												</div>
												<div class="col-sm-3 mt-2 d-flex justify-content-between">
													<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $produto->id_produto ?>)"></i>
													<?php if($produto->status == 'disponivel') { ?>
														<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $produto->id_produto ?>, '<?= $produto->nome ?>')"></i>
														<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $produto->id_produto ?>)"></i>
													<? } ?>
												</div>
											</div>
										<? } ?>
										<!--Usuário normal, com perfil_id = 2, tem acesso a suas inclusões apenas-->
										<?php if ($_SESSION['perfil_id'] == 2 && $_SESSION['id_usuario'] == $produto->id_usuario) { ?>
											<div class="row mb-3 d-flex align-items-center produto">
												<div class="col-sm-9" id="produto_<?= $produto->id_produto ?>">
													<?= $produto->nome ?> (<?= $produto->status ?>)
												</div>
												<div class="col-sm-3 mt-2 d-flex justify-content-between">
													<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $produto->id_produto ?>)"></i>
													<?php if($produto->status == 'disponivel') { ?>
														<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $produto->id_produto ?>, '<?= $produto->nome ?>')"></i>
														<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $produto->id_produto ?>)"></i>
													<? } ?>
												</div>
											</div>
										<? } ?>
									<? } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>