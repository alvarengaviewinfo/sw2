<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>

<body>
    <?php
        require 'bd/conexao.php';

    //Atribui uma conexão PDO
    $conexao = conexao::getInstance();

    //Recebe os dados enviados pela submissão
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
    $cnpj = (isset($_POST['cnpj'])) ? str_replace(array('.','-'),'',$_POST['cnpj']) : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $site = (isset($_POST['site'])) ? $_POST['site'] : '';
    $telefone = (isset($_POST['telefone'])) ? str_replace(array('-',' '),'', $_POST['telefone']) : '';
    $celular = (isset($_POST['celular'])) ? str_replace(array('-',' '),'', $_POST['celular']) : '';
    $data_abertura = (isset($_POST['data_abertura'])) ? $_POST['data_abertura'] : '';
    $status = (isset($_POST['status'])) ? $_POST['status'] : '';
    
    //Valida os dados recebidos
    $mensagem = '';

    //Se for ação diferente de excluir valida os dados obrigatórios
    if ($acao != 'excluir'):
        if($nome == '' || strlen($nome)< 3):
           $mensagem .= '<li>Favor preencher o Nome</li>';
        endif;

        if ($cnpj == ''):
            $mensagem .= '<li> Favor preencher o Cnpj</li>';
        elseif (strlen($cnpj)< 14):
            $mensagem .= '<li> Formato do Cnpj inválido.</li>';    
        endif;

        if ($email == ''):
            $mensagem .= '<li>Favor preencher o E-mail</li>';
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $mensagem .= '<li>Formato do E-mail inválido</li>';
        endif;
        
        if ($data_abertura == ''):
            $mensagem .= '<li>Favor preencher a Data de Abertura</li>';
        else:
            $data = explode ('/', $data_abertura);
            if (!checkdate($data[1], $data[0], $data[2])):
                $mensagem .= '<li> Formato da Data de Abertura inválido</li>';    
            endif;
        endif;
        
        if($telefone ==''):
            $mensagem .= '<li>Favor preencher o Telefone.</li>';
        elseif(strlen($telefone)< 10):
            $mensagem .= '<li>Formato do Telefone inválido</li>';
        endif;

        if($celular ==''):
            $mensagem .= '<li>Favor preencher o Celular</li>';
        elseif(strlen($celular)< 11):
            $mensagem .= '<li>Formato de Celular inválido</li>';
        endif;

        if($status == ''):
            $mensagem .= '<li>Favor preencher os Status</li>';
        endif;

        if($mensagem != ''):
            $mensagem = '<ul>' .$mensagem . '</ul>';
            echo "<div class= 'alert alert-danger' role='alert'>".$mensagem."</div> ";
            exit;
        endif;

        //Constrói a data no formato ANSI yyyy/mm/dd
        $data_temp = explode('/', $data_abertura);
        $data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
        endif; 

        //Verifica se foi solicitada a inclusão de dados
        if($acao == 'incluir'):

            $sql = 'INSERT INTO cliente (nome, email, cnpj, data_abertura, telefone, celular, status)
                                VALUES(:nome, :email, :cnpj, :data_abertura, :telefone, :celular, :status)';
            $stm = $conexao->prepare($sql);
            $stm->bindValue(':nome', $nome);
            $stm->bindValue(':cnpj', $cnpj);
            $stm->bindValue(':email', $email);
            $stm->bindValue(':data_abertura', $data_ansi);
            $stm->bindValue(':telefone', $telefone);
            $stm->bindValue(':celular', $celular);
            $stm->bindValue(':status', $status);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-sucess' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div>";
            else:
                echo"<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div>";
            endif;
            
            echo "<meta http-equiv=refresh content='3;URL=index.php'>";
        endif;

        //Verifica se foi solicitada a edição de dados 
        if ($acao == 'editar'):

            $sql = 'UPDATE cliente SET nome=:nome, email=:email, cpf=:cpf, data_abertura=:data_abertura, telefone=:telefone, celular=:celular, status=:status ';
            $sql .= ' WHERE id=:id';

            $stm = $conexao->prepare($sql);
            $stm->bindValue(':nome',$nome);
            $stm->bindValue(':email',$email);
            $stm->bindValue(':cpf', $cpf);
            $stm->bindValue(':data_abertura',$data_ansi);
            $stm->bindValue(':telefone',$telefone);
            $stm->bindValue(':celular', $celular);
            $stm->bindValue(':status',$status);
            $stm->bindValue(':id',$id);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
            else:
                echo "<div class='alert alert-danger' role='alert'> Erro ao editar registro!</div>";
            endif;
            
            echo "<meta http-equiv=refresh content='3;URL=index.php'>";
        endif;

        //Verifica se foi solicitada a exclusão dos dados
        if ($acao == 'excluir'):

            //Exclui o registro do banco de dados
            $sql = 'DELETE FROM cliente WHERE id = :id';
            $stm = $conexao->prepare($sql);
            $stm->bindValue(':id', $id);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado...</div>";
            else: 
                echo "<div class='alert alert-danger' role='alert'> Erro ao excluir registro!</div>";
            endif;
            
            echo "<meta http-equiv=refresh content='3;URL=index.php'>";
        endif;
    ?>
</body>
</html>