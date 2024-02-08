    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Sistema de Cadastro</title>
        <!--- link css bootstrap -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>

    <body>
        <?php
        require 'bd/conexao.php';
        // Atribui uma conexão PDO
        $conexao = conexao::getInstance();
        // Recebe os dados enviados pela submissão
        $acao = (isset($_POST['acao'])) ? $_POST['acao'] : '';
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';
        $foto1 = (isset($_POST['foto1'])) ? $_POST['foto1'] : '';

        // Endereço da pasta
        $pasta = "img/produtos/";
        // Criar o diretório
        if (!file_exists($pasta)) {
            mkdir($pasta, 0755);
        }

        // Receber os arquivos do formulário
        $arquivo1 = $_FILES['foto1'];
        $arquivo2 = $_FILES['foto2'];
        $arquivo3 = $_FILES['foto3'];

        $foto1 = $arquivo1['name'];
        $foto2 = $arquivo2['name'];
        $foto3 = $arquivo3['name'];

        // Criar o endereço de destino das imagens
        $destino1 = $pasta . $foto1;
        if (!empty($foto2)) {
            $destino2 = $pasta . $foto2;
            // Acessa o IF quando realizar o upload corretamente
            if (move_uploaded_file($arquivo2['tmp_name'], $destino2)) {
                $mensagem = '';
            } else {
                $mensagem = "<p style='color: #f00;'>Erro: Imagem não cadastrada com sucesso!</p>";
            }
        } else {
            $destino2 = '';
        }
        if (!empty($foto3)) {
            $destino3 = $pasta . $foto3;
            // Acessa o IF quando realizar o upload corretamente
            if (move_uploaded_file($arquivo3['tmp_name'], $destino3)) {
                $mensagem = '';
            } else {
                $mensagem = "<p style='color: #f00;'>Erro: Imagem não cadastrada com sucesso!</p>";
            }        
        } else {
            $destino3 = '';
        }
        // Acessa o IF quando realizar o upload corretamente
        if (move_uploaded_file($arquivo1['tmp_name'], $destino1)) {
            $mensagem = '';
        } else {
            $mensagem = "<p style='color: #f00;'>Erro: Imagem não cadastrada com sucesso!</p>";
        }
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($nome == '' || strlen($nome) < 3):
                $mensagem .= '<li>Favor preencher o Nome. </li>';
            endif;
            if ($valor == ''):
                $mensagem .= '<li>Favor preencher o Preço de Venda.</li>';
            endif;
            if ($foto1 == ''):
                $mensagem .= '<li>Favor escolher uma foto.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem . "</div> ";
                exit;
            endif;
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):

            $sql = 'INSERT INTO produtos (pro_nome, pro_valor, pro_foto1, pro_foto2, pro_foto3)
                            VALUES (:pro_nome, :pro_valor, :pro_foto1, :pro_foto2, :pro_foto3)';
            $stm = $conexao->prepare($sql);
            $stm->bindValue(':pro_nome', $nome);
            $stm->bindValue(':pro_valor', $valor);
            $stm->bindValue(':pro_foto1', $destino1);
            $stm->bindValue(':pro_foto2', $destino2);
            $stm->bindValue(':pro_foto3', $destino3);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
            else:
                echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
            endif;

            echo "<meta http-equiv=refresh content= '3;URL=indexpro.php')";
        endif;

        // Verifica se foi solicitada a edição de dados
        if ($acao == 'editar'):

            $sql = 'UPDATE produtos SET pro_nome=:pro_nome, pro_valor=:pro_valor, pro_foto1=:pro_foto1, pro_foto2=:pro_foto2, pro_foto3=:pro_foto3 ';
            $sql .= ' WHERE pro_id=:id';

            $stm = $conexao->prepare($sql);
            $stm->bindValue(':pro_nome', $nome);
            $stm->bindValue(':pro_valor', $valor);
            $stm->bindValue(':pro_foto1', $pro_foto1);
            $stm->bindValue(':pro_foto2', $pro_foto2);
            $stm->bindValue(':pro_foto3', $pro_foto3);
            $stm->bindValue(':id', $id);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
            else:
                echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
            endif;

            echo "<meta http-equiv=refresh content='3;URL=indexpro.php'>";
        endif;

        // Verifica se foi solicitada a exclusão dos dados
        if ($acao == 'excluir'):    

            // Excluir o registro do banco de dados
            $sql = 'DELETE FROM produtos WHERE pro_id=:id';
            $stm = $conexao->prepare($sql);
            $stm->bindValue(':id', $id);
            $retorno = $stm->execute();

            if ($retorno):
                echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
            else:
                echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
            endif;

            echo "<meta http-equiv=refresh content='3;URL=indexpro.php'>";
        endif;
        ?>
    </body>

    </html>