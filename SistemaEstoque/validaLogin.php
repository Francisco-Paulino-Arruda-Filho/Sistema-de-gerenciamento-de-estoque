<?php
    session_start();
    require "conexao.php";
    $_SESSION;
    //Verifica se a autenticação está correta
    $usuario_autenticado = false;
    $usuario_id = null;

    $conexao = new Conexao();

    //Pega as informações do login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Chega se o usuário consta na base de dados e executa a query
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $conexao = $conexao->conectar();
    $stmt = $conexao->prepare($sql);
    
    $stmt->execute();
    
    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
    print_r($resultado);

    echo '<pre>';
    print_r($resultado);
    echo '<pre>';

    //Se estiver na lista de cadastrados
    if (!empty($resultado)) {
        $_SESSION['autenticado'] = 'SIM';
        //Variáveis úteis da sessão
        $_SESSION['id_usuario'] = $resultado[0]->id_usuario;
        $_SESSION['perfil_id'] = $resultado[0]->perfil_id;
        $usuario_autenticado = true;
        /*echo $_SESSION['id'];
        echo $_SESSION['perfil_id'];*/
        //Força o redirecionamento
        header('Location:novo_produto.php');
    } else {
        // Usuário não encontrado
        $usuario_autenticado = false;
        $_SESSION['autenticado'] = 'NAO';
        header('Location: index.php?login=erro');
    }

?>