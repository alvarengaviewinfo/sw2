<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Sistema de Cadastro</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
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
        $valor = (isset ($_POST['valor'])) ? $_POST['valor'] : '';
        $imagem1 = (isset($_POST['imagem1'])) ? $_POST['imagem1'] : '';

        // Verifica se o arquivo foi enviado sem erros
            if (isset($_FILES['imagem1']) && $_FILES['imagem1']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/produtos/';
                $imagem1 = $_FILES['imagem1']['name']; 
                if(pathinfo($imagem1, PATHINFO_EXTENSION) == "png"){
                    // Gera um nome único para a imagem usando timestamp
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpeg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    }
                }
                
                

                // Caminho completo onde a imagem será salva
                $caminhoCompleto1 = $diretorio . $nomeImagem;

                move_uploaded_file($_FILES['imagem1']['tmp_name'], $caminhoCompleto1);
            endif;

            $caminhoCompleto2 = '';
            if (isset($_FILES['imagem2']) && $_FILES['imagem2']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/produtos/';
                $imagem1 = $_FILES['imagem2']['name']; 
                if(pathinfo($imagem1, PATHINFO_EXTENSION) == "png"){
                    // Gera um nome único para a imagem usando timestamp
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpeg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    }
                }
                
                

                // Caminho completo onde a imagem será salva
                $caminhoCompleto2 = $diretorio . $nomeImagem;

                move_uploaded_file($_FILES['imagem2']['tmp_name'], $caminhoCompleto2);
            endif;


            $caminhoCompleto3 = '';
            if (isset($_FILES['imagem3']) && $_FILES['imagem3']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/produtos/';
                $imagem1 = $_FILES['imagem3']['name']; 
                if(pathinfo($imagem1, PATHINFO_EXTENSION) == "png"){
                    // Gera um nome único para a imagem usando timestamp
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpeg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    }
                }
                
                

                // Caminho completo onde a imagem será salva
                $caminhoCompleto3 = $diretorio . $nomeImagem;

                move_uploaded_file($_FILES['imagem3']['tmp_name'], $caminhoCompleto3);
            endif;
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($nome == '' || strlen($nome) < 3):
                $mensagem .= '<li>Favor preencher o Nome. </li>';
            endif;
            if ($valor == ''):
                $mensagem .= '<li>Favor preencher a Valor.</li>';
            endif;
            if ($_FILES["imagem1"] == ''):
                $mensagem .= '<li>Favor selecionar uma Imagem.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):
        $sql = 'INSERT INTO produtos (PRO_NOME, PRO_VALOR, PRO_FOTO1, PRO_FOTO2, PRO_FOTO3)
                        VALUES (:PRO_NOME, :PRO_VALOR, :PRO_FOTO1, :PRO_FOTO2, :PRO_FOTO3)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':PRO_NOME', $nome);
        $stm->bindValue(':PRO_VALOR', $valor);
        $stm->bindValue(':PRO_FOTO1', $caminhoCompleto1);
        $stm->bindValue(':PRO_FOTO2', $caminhoCompleto2);
        $stm->bindValue(':PRO_FOTO3', $caminhoCompleto3);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '1;URL=indexpro.php')";
    endif;

//     // Verifica se o formulário foi enviado
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Verifica se o arquivo foi enviado sem erros
//     if (isset($_FILES['imagem1']) && $_FILES['imagem1']['error'] === UPLOAD_ERR_OK) {
        
//         // Diretório onde a imagem será salva
//         $diretorio = 'css/';
        
//         // Gera um nome único para a imagem usando timestamp
//         $nomeImagem = time() . '_' . $_FILES['imagem1']['name'];

//         // Caminho completo onde a imagem será salva
//         $caminhoCompleto = $diretorio . $nomeImagem;

//         // Move o arquivo para o diretório desejado
//         if (move_uploaded_file($_FILES['imagem1']['tmp_name'], $caminhoCompleto)) {
            
//             // Agora, você pode salvar o caminho da imagem no banco de dados.
//             // Substitua esta parte com sua lógica de conexão com o banco de dados.
            
//             $conexao = new mysqli('seu_host', 'seu_usuario', 'sua_senha', 'seu_banco_de_dados');
            
//             if ($conexao->connect_error) {
//                 die('Erro de conexão: ' . $conexao->connect_error);
//             }

//             // Substitua 'sua_tabela' e 'campo_imagem' pelos nomes reais da sua tabela e coluna
//             $sql = "INSERT INTO sua_tabela (campo_imagem) VALUES ('$caminhoCompleto')";
            
//             if ($conexao->query($sql) === TRUE) {
//                 echo 'Imagem enviada com sucesso e caminho salvo no banco de dados.';
//             } else {
//                 echo 'Erro ao salvar no banco de dados: ' . $conexao->error;
//             }

//             $conexao->close();

//         } else {
//             echo 'Erro ao mover o arquivo para o diretório desejado.';
//         }

//     } else {
//         echo 'Erro no envio do arquivo.';
//     }
// }

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):

        // Obtém o nome da imagem do banco de dados
        $sql_select = 'SELECT PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos WHERE PRO_ID=:PRO_ID';
        $stm_select = $conexao->prepare($sql_select);
        $stm_select->bindValue(':PRO_ID', $id);
        $stm_select->execute();
        $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

        if ($resultado_select) {
            $nomeImagem1 = $resultado_select['PRO_FOTO1'];
            $nomeImagem2 = $resultado_select['PRO_FOTO2'];
            $nomeImagem3 = $resultado_select['PRO_FOTO3'];

            // Verifica se o arquivo existe antes de tentar excluí-lo
            if (file_exists($nomeImagem1)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem1);
            }
            if (file_exists($nomeImagem2)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem2);
            }
            if (file_exists($nomeImagem3)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem3);
            }
        }

        $sql = 'UPDATE produtos SET PRO_NOME=:PRO_NOME, PRO_VALOR=:PRO_VALOR,PRO_FOTO1=:PRO_FOTO1,PRO_FOTO2=:PRO_FOTO2,PRO_FOTO3=:PRO_FOTO3';
        $sql .= ' WHERE PRO_ID=:PRO_ID';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':PRO_FOTO3', $caminhoCompleto3);
        $stm->bindValue(':PRO_FOTO2', $caminhoCompleto2);
        $stm->bindValue(':PRO_FOTO1', $caminhoCompleto1);
        $stm->bindValue(':PRO_NOME', $nome);
        $stm->bindValue(':PRO_VALOR', $valor);
        $stm->bindValue(':PRO_ID', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexpro.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):
        // Obtém o nome da imagem do banco de dados
        $sql_select = 'SELECT PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos WHERE PRO_ID=:PRO_ID';
        $stm_select = $conexao->prepare($sql_select);
        $stm_select->bindValue(':PRO_ID', $id);
        $stm_select->execute();
        $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

        if ($resultado_select) {
            $nomeImagem1 = $resultado_select['PRO_FOTO1'];
            $nomeImagem2 = $resultado_select['PRO_FOTO2'];
            $nomeImagem3 = $resultado_select['PRO_FOTO3'];

            // Verifica se o arquivo existe antes de tentar excluí-lo
            if (file_exists($nomeImagem1)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem1);
            }
            if (file_exists($nomeImagem2)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem2);
            }
            if (file_exists($nomeImagem3)) {
                // Exclui a imagem do diretório
                unlink($nomeImagem3);
            }
        }

        // Excluir o registro do banco de dados
        $sql = 'DELETE FROM produtos WHERE PRO_ID=:PRO_ID';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':PRO_ID', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='1;URL=indexpro.php'>";
    endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>