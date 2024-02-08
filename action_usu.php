<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Sistema de Cadastro</title>
    <!--- link css bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
 <body>
    <?php
        require 'bd/conexao.php';
        // Atribui uma conexão PDO
        $conexao = conexao::getInstance();
        // Recebe os dados enviados pela submissão
        $acao = (isset ($_POST['acao'])) ? $_POST['acao'] : '';
        $id = (isset ($_POST['id'])) ? $_POST['id'] : '';
        $nome = (isset ($_POST['nome'])) ? $_POST['nome'] : '';
        $senha = (isset ($_POST['senha'])) ? $_POST['senha'] : '';
        $email = (isset ($_POST['email'])) ? $_POST['email'] : '';
        $celular = (isset ($_POST ['celular'])) ? str_replace(array('-',' '), '',$_POST['celular']) : '';
        $status = (isset ($_POST[ 'status'])) ? $_POST['status'] : '';
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($nome == '' || strlen($nome) < 3):
                $mensagem .= '<li>Favor preencher o Nome. </li>';
            endif;
            if ($senha == ''):
                $mensagem .= '<li>Favor preencher a Senha.</li>';
            endif;
            if ($email == ''):
                $mensagem .= '<li>Favor preencher o E-mail.</li>';
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $mensagem .= '<li>Formato do E-mail inválido.</li>';
            endif;
            if ($celular == ''):
                $mensagem .= '<li>Favor preencher O Celular.</li>';
            elseif (strlen($celular) < 11):
                $mensagem .= '<li>Formato do Celular inválido. </li>';
            endif;
            if ($status == ''):
                $mensagem .= '<li>Favor preencher O Status.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):

        $sql = 'INSERT INTO usuario (nome, email, senha, celular, status)
                        VALUES (:nome, :email, :senha, :celular, :status)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':senha', $senha);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':status', $status);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '3;URL=indexusu.php')";
    endif;

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):

        $sql = 'UPDATE usuario SET nome=:nome, email=:email, senha=:senha, celular=:celular, status=:status ';
        $sql .= ' WHERE id=:id';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':senha', $senha);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':status', $status);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexusu.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):

        // Excluir o registro do banco de dados
        $sql = 'DELETE FROM usuario WHERE id=:id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexusu.php'>";
    endif;
    ?>
</body>
</html>