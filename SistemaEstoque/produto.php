<?php

class Produto {
	private $nome;
	private $id;
	private $id_status;
	private $data_cadastro;
    private $id_usuario;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}

?>