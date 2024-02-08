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
        $cnpj = (isset ($_POST['cnpj'])) ? str_replace(array('.','-'), '', $_POST['cnpj']) : '';
        $email = (isset ($_POST['email'])) ? $_POST['email'] : '';
        $data_abertura = (isset ($_POST['data_abertura'])) ? $_POST['data_abertura'] : '';
        $telefone = (isset ($_POST ['telefone'])) ? str_replace(array('-',' '), '',$_POST['telefone']) : '';
        $celular = (isset ($_POST ['celular'])) ? str_replace(array('-',' '), '',$_POST['celular']) : '';
        $site = (isset ($_POST ['site'])) ? $_POST['site'] : '';
        $contato = (isset($_POST ['contato'])) ? $_POST['contato'] : '';
        $status = (isset ($_POST[ 'status'])) ? $_POST['status'] : '';
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($nome == '' || strlen($nome) < 3):
                $mensagem .= '<li>Favor preencher o Nome. </li>';
            endif;
            if ($contato == '' || strlen($contato) < 3):
                $mensagem .= '<li>Favor preencher o Contato. </li>';
            endif;
            if ($cnpj == ''):
                $mensagem .= '<li>Favor preencher o CNPJ.</li>';
            elseif(strlen($cnpj) < 15):
                $mensagem .= '<li>Formato do CNPJ inválido.</li>';
            endif;
            if ($email == ''):
                $mensagem .= '<li>Favor preencher O E-mail.</li>';
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $mensagem .= '<li>Formato do E-mail inválido.</li>';
            endif;
            if ($data_abertura == ''):
                $mensagem .= '<li>Favor preencher a Data de Abertura.</li>';
            else:
                $data = explode('/', $data_abertura);
                if (!checkdate($data[1], $data[0], $data[2])):
                    $mensagem .= '<li>Formato da Data de Abertura inválido.</li>';
                endif;
            endif;
            if ($telefone == ''):
                $mensagem .= '<li>Favor preencher o Telefone.</li>';
            elseif(strlen($telefone) < 10):
                $mensagem .= '<1i>Formato do Telefone inválido. </li>';
            endif;
            if ($celular == ''):
                $mensagem .= '<li>Favor preencher O Celular.</li>';
            elseif (strlen($celular) < 11):
                $mensagem .= '<li>Formato do Celular inválido. </li>';
            endif;
            if ($site == ''):
                $mensagem .= '<li>Favor preencher O Site.</li>';
            endif;
            if ($status == ''):
                $mensagem .= '<li>Favor preencher O Status.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
            // Constrói a data no formato ANSI yyyy/mm/dd
            $data_temp  = explode('/', $data_abertura);
            $data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):

        $sql = 'INSERT INTO fornecedor (nome, contato, email, cnpj, data_abertura, telefone, celular, site, status)
                        VALUES (:nome, :contato, :email, :cnpj, :data_abertura, :telefone, :celular, :site, :status)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':contato', $contato);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':cnpj', $cnpj);
        $stm->bindValue(':data_abertura', $data_ansi);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':site', $site);
        $stm->bindValue(':status', $status);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '3;URL=indexfor.php')";
    endif;

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):

        $sql = 'UPDATE fornecedor SET nome=:nome,contato=:contato , email=:email, cnpj=:cnpj, data_abertura=:data_abertura, telefone=:telefone, celular=:celular,site=:site, status=:status ';
        $sql .= ' WHERE id=:id';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':contato', $contato);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':cnpj', $cnpj);
        $stm->bindValue(':data_abertura', $data_ansi);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':celular', $celular);
        $stm->bindValue(':site', $site);
        $stm->bindValue(':status', $status);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexfor.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):

        // Excluir o registro do banco de dados
        $sql = 'DELETE FROM fornecedor WHERE id=:id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexfor.php'>";
    endif;
    ?>
</body>
</html>