<?php
	session_start(); // Inicia a sessão
	require "produto.php";
	require "produto_service.php";
	require "conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir' ) {
		$produto = new Produto();
		$produto->__set('nome', $_POST['produto']);
		$produto->__set('id_usuario', $_SESSION['id_usuario']);

		$conexao = new Conexao();

		$produtoService = new ProdutoService($conexao, $produto);

		$produtoService->inserir();

		header('Location: novo_produto.php?inclusao=1');
	
	} else if($acao == 'recuperar') {
		$produto = new Produto();
		$conexao = new Conexao();

		$produtoService = new ProdutoService($conexao, $produto);

		$produtos = $produtoService->recuperar();
	
	} else if($acao == 'atualizar') {
		$produto = new Produto();
		echo $_POST['id_produto'] . '<br>';
		echo $_POST['produto'];
		$produto->__set('id', $_POST['id_produto'])
		->__set('nome', $_POST['produto']);

		$conexao = new Conexao();

		$produtoService = new ProdutoService($conexao, $produto);
		
		if($produtoService->atualizar()) {
			header('location: todos_produtos.php');
		}

	} else if($acao == 'remover') {
		
		$produto = new Produto();
		$produto->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$produtoService = new ProdutoService($conexao, $produto);
		$produtoService->remover();

		header('location: todos_produtos.php');
		
	} else if($acao == 'marcarRealizada') {
		
		$produto = new Produto();
		$produto->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$produtoService = new ProdutoService($conexao, $produto);

		$produtoService->marcarRealizada();

		header('location: todos_produtos.php');
	}

?>