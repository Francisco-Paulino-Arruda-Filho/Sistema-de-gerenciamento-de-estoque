<?php


//CRUD
class ProdutoService {

	private $conexao;
	private $produto;

	public function __construct(Conexao $conexao, Produto $produto) {
		$this->conexao = $conexao->conectar();
		$this->produto = $produto;
	}

	public function inserir() { //create
		$query = 'INSERT INTO produto(nome, id_usuario)VALUES(:nome, :id_usuario)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->produto->__get('nome'));
        $stmt->bindValue(':id_usuario', $this->produto->__get('id_usuario'));
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = '
				SELECT 
					p.id_produto, s.status, p.nome , s.id, p.id_usuario
				FROM 
					produto AS p 
				LEFT JOIN 
					status AS s ON (p.id_status = s.id)'
		;
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update
		$query = "UPDATE produto SET nome = ? WHERE id_produto = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->produto->__get('nome'));
		$stmt->bindValue(2, $this->produto->__get('id'));
		return $stmt->execute(); 
	}

	public function remover() { //delete
		$query = 'DELETE FROM produto where id_produto = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->produto->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada() { //update
		$query = "UPDATE produto SET id_status = ? WHERE id_produto = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, 2);
		$stmt->bindValue(2, $this->produto->__get('id'));
		return $stmt->execute(); 
	}
}

?>